<?php

namespace PersiaFava\Sms;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use PersiaFava\Sms\Exceptions\SmsException;

/**
 * Class SmsService
 *
 * This is the core engine of the SDK. It handles all Guzzle HTTP requests,
 * authentication, and error handling for the PersiaFava ESB V2 API.
 */
class SmsService
{
    /**
     * @var Client The Guzzle HTTP client instance.
     */
    protected $client;

    /**
     * @var string The Basic Authentication header string.
     */
    protected $authHeader;

    /**
     * SmsService constructor.
     *
     * @param string $authString The Base64 encoded auth string (username:password).
     */
    public function __construct($authString)
    {
        $this->client = new Client([
            'timeout' => 5.0, // Default timeout of 5 seconds
        ]);
        $this->authHeader = 'Basic ' . $authString;
    }

    /**
     * Handles a successful Guzzle response.
     *
     * @param \Psr\Http\Message\ResponseInterface $response
     * @return SmsResult
     * @throws SmsException
     */
    protected function handleResponse($response)
    {
        $body = json_decode($response->getBody(), true);
        $statusCode = $response->getStatusCode();
        $apiStatus = $body['status'] ?? -1; // Use -1 for unknown error
        $message = $body['messages'] ?? ($body['message'] ?? 'Unknown error');

        // ESB V2 uses status 0 for success
        if ($apiStatus === 0) {
            return new SmsResult($apiStatus, $message, $body);
        }

        // Handle known API errors (non-zero status)
        throw new SmsException($message, $apiStatus);
    }

    /**
     * Handles a Guzzle-level exception (e.g., connection timeout, 404, 500).
     *
     * @param RequestException $e
     * @return SmsResult
     * @throws SmsException
     */
    protected function handleException(RequestException $e)
    {
        $response = $e->getResponse();
        $message = $e->getMessage();
        $statusCode = $response ? $response->getStatusCode() : 500; // HTTP Status Code

        if ($response) {
            $errorBody = json_decode($response->getBody(), true);
            $message = $errorBody['messages'] ?? ($errorBody['message'] ?? $message);
        }

        // Rethrow as our custom exception
        throw new SmsException($message, $statusCode);
    }

    /**
     * The core method for sending all HTTP requests.
     *
     * @param string $method The HTTP method (GET, POST).
     * @param string $uri The full endpoint URI.
     * @param array $options Guzzle request options (e.g., 'json', 'query').
     * @return SmsResult
     * @throws SmsException
     */
    private function sendRequest($method, $uri, $options = [])
    {
        try {
            // Add auth and common headers to every request
            $options['headers']['Authorization'] = $this->authHeader;
            $options['headers']['Accept'] = 'application/json';
            
            // Set content-type only for POST/PUT requests with a body
            if (in_array($method, ['POST', 'PUT', 'PATCH']) && (isset($options['json']) || isset($options['form_params']))) {
                 $options['headers']['Content-Type'] = 'application/json';
            }

            $response = $this->client->request($method, $uri, $options);

            return $this->handleResponse($response);

        } catch (RequestException $e) {
            // Handle Guzzle HTTP errors
            return $this->handleException($e);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            throw new SmsException("An unexpected SDK error occurred: " . $e->getMessage(), 500);
        }
    }

    //======================================================================
    // API METHODS (ESB V2)
    //======================================================================

    /**
     * Sends peer-to-peer (one-to-one) messages.
     *
     * @param array $senders
     * @param array $recipients
     * @param array $messages
     * @param array $uids
     * @return SmsResult
     * @throws SmsException
     */
    public function peerToPeer(array $senders, array $recipients, array $messages, array $uids)
    {
        $uri = 'https://sms.persiafava.com:3000/PeerToPeer';
        $body = [
            'senders' => $senders,
            'recipients' => $recipients,
            'messages' => $messages,
            'uids' => $uids,
        ];
        return $this->sendRequest('POST', $uri, ['json' => $body]);
    }

    /**
     * Sends a bulk (one-to-many) message.
     *
     * @param string $sender
     * @param array $recipients
     * @param string $message
     * @param array $uids
     * @return SmsResult
     * @throws SmsException
     */
    public function bulk(string $sender, array $recipients, string $message, array $uids)
    {
        $uri = 'https://sms.persiafava.com:3001/Bulk';
        $body = [
            'sender' => $sender,
            'recipients' => $recipients,
            'message' => $message,
            'uids' => $uids,
        ];
        return $this->sendRequest('POST', $uri, ['json' => $body]);
    }

    /**
     * Sends a single OTP (One-Time Password) message.
     *
     * @param string $sender
     * @param string $recipient
     * @param string $message
     * @param string $uid
     * @return SmsResult
     * @throws SmsException
     */
    public function otp(string $sender, string $recipient, string $message, string $uid)
    {
        $uri = 'https://sms.persiafava.com:3002/Otp';
        $body = [
            'sender' => $sender,
            'recipient' => $recipient,
            'message' => $message,
            'uid' => $uid,
        ];
        return $this->sendRequest('POST', $uri, ['json' => $body]);
    }

    /**
     * Gets the delivery status for multiple SMS IDs.
     *
     * @param array $smsids
     * @return SmsResult
     * @throws SmsException
     */
    public function getDelivery(array $smsids)
    {
        $uri = 'https://sms.persiafava.com:3003/Delivery';
        // The body is just the array of IDs
        return $this->sendRequest('POST', $uri, ['json' => $smsids]);
    }

    /**
     * Gets the user's account info (balance, etc.).
     *
     * @return SmsResult
     * @throws SmsException
     */
    public function getUserInfo()
    {
        $uri = 'https://sms.persiafava.com:3006/UserInfo';
        return $this->sendRequest('GET', $uri);
    }

    /**
     * Gets a paginated list of received messages (MO).
     *
     * @param array $options (page_number, perpage, read, etc.)
     * @return SmsResult
     * @throws SmsException
     */
    public function getReceivedList(array $options = [])
    {
        $uri = 'https://sms.persiafava.com:3004/ReceivedList';
        return $this->sendRequest('POST', $uri, ['json' => $options]);
    }

    /**
     * Marks received messages as read or unread.
     *
     * @param array $ids
     * @param int $read (1 for read, 0 for unread)
     * @return SmsResult
     * @throws SmsException
     */
    public function markReceivedAsRead(array $ids, $read = 1)
    {
        $uri = 'https://sms.persiafava.com:3005/ReceivedChangeRead';
        $body = [
            'read' => $read,
            'ids' => $ids,
        ];
        return $this->sendRequest('POST', $uri, ['json' => $body]);
    }
}
