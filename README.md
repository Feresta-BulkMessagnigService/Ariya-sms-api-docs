مستندات و نمونه کدهای وب‌سرویس پیام کوتاه

این مخزن (Repo) شامل مستندات فنی، راهنماها و نمونه کدهای لازم برای اتصال به پلتفرم‌های مختلف وب‌سرویس پیام کوتاه ما است.

محتویات مخزن

api_documentation_professional.html

مستندات اصلی و کامل HTML. این فایل شامل راهنمای تعاملی هر سه پلتفرم، با قابلیت حالت تاریک/روشن و دکمه‌های کپی کد است. این مرجع اصلی شماست.

SMS_API_Collection_v3.postman_collection.json

مجموعه Postman. شامل تمام درخواست‌های API برای هر سه پلتفرم، آماده برای Import و تست.

README.md

(همین فایل) راهنمای کلی مخزن.

composer.json و .gitignore

فایل‌های پیکربندی پایه برای PHP SDK.

config/ و src/

پوشه‌های حاوی کدهای PHP SDK (در حال توسعه).

api_documentation_minimal_for_word.html

نسخه Word (جهت ویرایش داخلی). یک نسخه HTML ساده‌شده که می‌توانید آن را مستقیماً در Microsoft Word باز کنید (File > Open) تا محتوا را ویرایش یا بررسی کنید. این فایل برای مشتریان نهایی نیست.

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

کتابخانه‌های کلاینت (SDKs)

برای سرعت بخشیدن به فرآیند یکپارچه‌سازی، ما در حال توسعه کتابخانه‌های کلاینت (SDK) برای زبان‌های برنامه‌نویسی محبوب هستیم.

PHP (Laravel)

پایه و اساس PHP SDK ما در این مخزن موجود است.

پیکربندی: composer.json

کدها: پوشه‌های src/ و config/

راه‌اندازی سریع (Postman):

فایل SMS_API_Collection_v3.postman_collection.json را در Postman خود Import کنید.

یک Environment جدید در Postman بسازید.

متغیرهای زیر را بر اساس اطلاعات حساب کاربری خود در Environment تنظیم کنید:

base_url_legacy: http://sms.persiafava.com

base_url_esb_1_5: https://sms.persiafava.com:7074

base_url_esb_v2_base: https://sms.persiafava.com

api_key_legacy: (کلید API دریافتی از پنل Legacy)

auth_string_esb: (رشته احراز هویت Basic برای پلتفرم‌های ESB 1.5 و V2)

زبان‌های دیگر (در حال توسعه)

SDK برای پلتفرم‌های زیر در نقشه راه ما قرار دارد:

Node.js (JavaScript/TypeScript)

Python

.NET (C#)
