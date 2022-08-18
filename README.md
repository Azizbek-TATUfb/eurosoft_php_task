# PHP dasturchi uchun test

Assalomu alaykum!

Agar sizga ushbu test berilgan bo'lsa demak siz uchun bizning jamoaga qo'shilish imkoniyati oz qoldi demakdir. Saralash jarayonidan muvaffaqiyatli o'tganingiz bilan tabriklaymiz!

Bu test sizning PHP va dasturlashda qanday darajada ekanligingizni bilib olish uchun tayyorlangan. Pasda bir qancha savollar bor va bu savollarga javob berishda bor bilim va maxoratingizni isha soling.

Savollarning javobini yozishda GitHub yoki Gitlab dan `eurosoft_php_task` deya project yarating va ichiga javoblarni yozib bizga jo'nating. `test` papkasiga qarasangiz har bir javob uchun alohida bir fayl yaratilganini ko'rasiz. Siz ham xuddi shunday ko'rinshda har bir javob uchun alohida fayl yarating va ichiga savolning yechimini yozing.

Omad tilaymiz!

## Savollar

**1 - savol:**\
JSON formatida faylga array yozishni qanday amalga oshirasiz? Misol uchun quyidagi array ga qarang va berilgan arrayni php dan foydalangan holda `myarray.json` faylini yaratib ichiga yozib bering.

```php
$myarray = array(
    'hello' => 'world',
    'coding' => 'is cool',
);
```

--

**2 - savol:**\
JSON formatida data olish va ishlash:

- Yuqoridagi `github.json` faylidan datalarni olib array ko'rinishida `var_dumb` qiling. 

- `https://api.github.com/` URL idan JSON datalarni olib object ko'rinishida `var_dumb` qiling. 

--

**3 - savol:**\
Misol uchun DB dan kitoblarni olib chiqarib berishingiz kerak. Kitoblarni DB dan olganingizda array ko'rinishida keldi deyaylik. Array esa bu:

```php
$results = array(
    0 => array(
        'name' => 'Shaytanat',
        'author' => 'Toxir Malik',
        'year' => 2006
    ),
    1 => array(
        'name' => 'Zulmatdagi saltanat',
        'author' => 'Abdurahimov O‘tkir',
        'year' => 2019
    ),
    2 => array(
        'name' => 'Двойник',
        'author' => 'Фёдор Достоевский',
        'year' => 1846,
    ),
);
```

Bularni pagega chiqarishda bir class va construct bilan ishlagan holda amalga oshiring. HTML / CSS dan foydalangan holda pasdagi ko'rinish kabi chiqaring:

```html
<h3>Kitob: Shaytanat</h3>
<p>Toxir Malik | 2006</p>

<h3>Kitob: Zulmatdagi saltanat</h3>
<p>Abdurahimov O‘tkir | 2019</p>

<h3>Kitob: Двойник</h3>
<p>Фёдор Достоевский | 1846</p>
```

--

**4 - savol:**\
DB da 2 ta tablitsa bor: `users` va `profile`\
Bu yerdan SQL ni ishlatgan holda userga profileni JOIN qilib 4 ta data olish kerak. Where uchun `user.status = 1` ni ishlatasiz. Buni SQL da qanday yozishingizni va PHP da fetch qilishingizni yozib ko'rsating.

--

**5 - savol:**\
Saytga kelan odamning IP, OS va Browser ma'lumotlarini olishimiz kerak. Buning uchun 3 dona funksiya yaratib foydalanishingiz kerak bo'ladi:

- getUserIP()
- getUserOS()
- getUserBrowser()

Shu ko'rinishda 3 dona funksiya yarating va yuqorida aytilgan userga oid ma'lumotlarni funksiya ichida array ko'rinishida return qiling.

--

**6 - savol:**\
Saytda contact form bor va u yerdan xatlar keladi. Siz bu xatni POST orqali array ko'rinishida olasiz va buni DB ga qayd qilishdan oldin barcha HTML kodlarni tozalab tashlashingiz kerak bo'ladi. Buni qanday amalga oshirasiz?

Array misoli quyida berilgandir. Bizga arrayni qanday qilib tozalashingizni va bu tozalangan arrayni SQL bilan `contact_messages` tablitsasiga insert qilishingizni kodda ko'rsatib bering.

```php
$form_data = array(
    'name' => 'Eshmatvoy',
    'surname' => 'Toshmatov',
    'email' => 'eshmatvoy@mail.ru',
    'message' => '<b>Assalomu alaykum!</b><span>Men sizga yozayotganimdan maqsad shuki...</span><script>alert("Voy!");</script>',
);
```

--

**7 - savol:**\
Sizning **MVC** bilan ishlay olish qobiliyatingizni ko'rmoqchimiz. Project papkangizda `mvc` deya bir papka yarating va ichida qilingan ishlaringzidan bir dona MVC ga misol bola oladigan kodlarni qo'ying.

--

**8 - savol:**\
**Yii2** yoki **Laravel** frameworkida yangi bir module yaratishni qanday amalga oshirishingizni ko'rsatib bering.

--

**9 - savol:**\
**Yii2** yoki **Laravel** frameworkida yangi bir console command yaratishni qanday amalga oshirishingizni ko'rsatib bering.

Command shunday ko'rinishda bo'lsin:

```
php yii mycommand/welcome
php artisan mycommand/welcome
```

Bu console command bizga **Hello World!** deya javob bersin. 

--

**10 - savol:**\
**Yii2** frameworkida `frontend/views` papkasini boshqa joydagi papkaga (misol uchun common/views) o'zgartirmoqchi bo'lsak bu ishni qanday amalga oshirishingizni ko'rsatib bering.
