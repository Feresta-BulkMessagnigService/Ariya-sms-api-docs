<div dir="rtl">

مستندات و نمونه کدهای وب‌سرویس پیام کوتاه

این مخزن (Repo) شامل مستندات فنی، راهنماها و نمونه کدهای لازم برای اتصال به پلتفرم‌های مختلف وب‌سرویس پیام کوتاه ما است.

نمای کلی پلتفرم‌ها

سیستم ما از چندین پلتفرم API پشتیبانی می‌کند که نشان‌دهنده تکامل سرویس‌های ما هستند:

پلتفرم (Legacy - PersiaFava):

توضیحات: پلتفرم قدیمی‌تر که شامل متدهای REST (مانند sms_send)، SOAP و متدهای ناامن GET می‌باشد.

احراز هویت: مبتنی بر api_key یا username/password در Query String.

پلتفرم ۱.۵ (ESB - Persia Fava):

توضیحات: اولین نسخه از پلتفرم ESB که بر روی پورت 7074 اجرا می‌شود و متد اصلی send را ارائه می‌دهد.

احراز هویت: مبتنی بر Authorization: Basic [auth_string] در هدر (Header).

پلتفرم ۲ (ESB V2):

توضیحات: جدیدترین و توصیه‌شده‌ترین پلتفرم ESB که شامل متدهای مدرن و تفکیک‌شده مانند PeerToPeer، Bulk و Otp می‌باشد.

احراز هویت: مبتنی بر Authorization: Basic [auth_string] در هدر (Header).

توصیه می‌شود توسعه‌دهندگان جدید مستقیماً از پلتفرم ۲ (ESB V2) برای پیاده‌سازی‌های خود استفاده کنند.

راهنمای کامل API

راهنمای کامل و تعاملی HTML، شامل تمام متدها، پارامترها، نمونه کدها و لیست خطاها برای هر سه پلتفرم، در فایل زیر موجود است:

api_documentation_professional.html

این فایل، مرجع اصلی و کامل برای تمام پلتفرم‌ها می‌باشد.

استفاده از Postman

ما یک مجموعه کامل Postman (SMS_API_Collection_v3.postman_collection.json) فراهم کرده‌ایم که شامل تمام درخواست‌های مستند شده برای هر سه پلتفرم است.

راه‌اندازی سریع:

فایل SMS_API_Collection_v3.postman_collection.json را در Postman خود Import کنید.

یک Environment جدید در Postman بسازید.

متغیرهای زیر را بر اساس اطلاعات حساب کاربری خود در Environment تنظیم کنید:

base_url_legacy: http://sms.persiafava.com

base_url_esb_1_5: https://sms.persiafava.com:7074

base_url_esb_v2_base: https://sms.persiafava.com

api_key_legacy: (کلید API دریافتی از پنل Legacy)

auth_string_esb: (رشته احراز هویت Basic برای پلتفرم‌های ESB 1.5 و V2)

پس از تنظیم این متغیرها، شما آماده تست تمام APIها هستید.

</div>