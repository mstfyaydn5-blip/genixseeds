<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class GenixProductsSeeder extends Seeder
{
    public function run(): void
    {
        $brand = 'genix';

        // Copy the real product photos shipped with this seeder into public storage
        $srcDir = database_path('seed-images/products/genix');
        $destDir = storage_path('app/public/products/genix');
        if (File::isDirectory($srcDir)) {
            File::ensureDirectoryExists($destDir);
            File::copyDirectory($srcDir, $destDir);
        }

        $categories = [
            'cabbage' => ['name_en' => 'Cabbage', 'name_ar' => 'الملفوف', 'order' => 10],
            'cauliflower' => ['name_en' => 'Cauliflower', 'name_ar' => 'القرنبيط', 'order' => 20],
            'cucumber-greenhouse' => ['name_en' => 'Cucumber (Greenhouse)', 'name_ar' => 'الخيار (بيوت محمية)', 'order' => 30],
            'cucumber-open-field' => ['name_en' => 'Cucumber (Open Field)', 'name_ar' => 'الخيار (حقل مفتوح)', 'order' => 40],
            'eggplant' => ['name_en' => 'Eggplant', 'name_ar' => 'الباذنجان', 'order' => 50],
            'lettuce' => ['name_en' => 'Lettuce', 'name_ar' => 'الخس', 'order' => 60],
            'melon' => ['name_en' => 'Melon', 'name_ar' => 'الشمام', 'order' => 70],
            'onion' => ['name_en' => 'Onion', 'name_ar' => 'البصل', 'order' => 80],
            'pepper' => ['name_en' => 'Pepper', 'name_ar' => 'الفلفل', 'order' => 90],
            'squash' => ['name_en' => 'Squash', 'name_ar' => 'الكوسا', 'order' => 100],
            'tomato' => ['name_en' => 'Tomato', 'name_ar' => 'الطماطم', 'order' => 110],
            'watermelon' => ['name_en' => 'Watermelon', 'name_ar' => 'البطيخ', 'order' => 120],
        ];

        $categoryIds = [];
        foreach ($categories as $key => $cat) {
            $model = ProductCategory::updateOrCreate(
                ['slug' => $brand.'-'.$key],
                [
                    'name_en' => $cat['name_en'],
                    'name_ar' => $cat['name_ar'],
                    'brand' => $brand,
                    'order' => $cat['order'],
                    'is_active' => true,
                ]
            );
            $categoryIds[$key] = $model->id;
        }

        $products = [
            [
                'category_key' => 'cabbage',
                'sku' => 'GX11C01',
                'name_en' => 'Cabbage - GX11C01',
                'name_ar' => 'الملفوف - GX11C01',
                'slug' => 'genix-gx11c01',
                'description_en' => '- Compact Vegetation
- Uniform Globe Head
- Average Head Weight 2 Kg
- Excellent Field Holding Capacity, Flexible Variety
- Suitable for Autumn & Winter Segments',
                'description_ar' => '- نمو خضري مدمج
- رأس كروي متجانس
- متوسط وزن الرأس 2 كغم
- قدرة ممتازة على الاحتفاظ بالمحصول في الحقل، صنف مرن
- مناسب لموسمي الخريف والشتاء',
                'image' => 'products/genix/genix-gx11c01.jpg',
                'order' => 10,
            ],
            [
                'category_key' => 'cabbage',
                'sku' => 'GX11C02',
                'name_en' => 'Cabbage - GX11C02',
                'name_ar' => 'الملفوف - GX11C02',
                'slug' => 'genix-gx11c02',
                'description_en' => '- Strong Plant with Good Leaf Cover
- Uniform Oblate Shape Head (Semi Flat )
- Deep Green Color
- Average Head Weight 2.0 Kg
- Suitable for Autumn & Winter Segments',
                'description_ar' => '- نبات قوي بتغطية ورقية جيدة.
- رأس مفلطح متجانس (شبه مسطح)
- لون أخضر داكن
- متوسط وزن الرأس 2.0 كغم
- مناسب لموسمي الخريف والشتاء',
                'image' => 'products/genix/genix-gx11c02.jpg',
                'order' => 20,
            ],
            [
                'category_key' => 'cabbage',
                'sku' => 'GX11C03',
                'name_en' => 'Cabbage - GX11C03',
                'name_ar' => 'الملفوف - GX11C03',
                'slug' => 'genix-gx11c03',
                'description_en' => '- Strong Plant with Good Leaf Cover
- Globe Shape Head, Small Core
- Bright Purple Red Color
- Average Head Weight 1.5 Kg
- Distinguished Quality, Cold Tolerance
- Suitable for Autumn, Winter & Spring Segments',
                'description_ar' => '- نبات قوي بتغطية ورقية جيدة.
- رأس كروي الشكل بقلب صغير
- لون أرجواني مائل للأحمر لامع
- متوسط وزن الرأس 1.5 كغم
- جودة مميزة، وتحمل للبرودة
- مناسب لمواسم الخريف والشتاء والربيع',
                'image' => 'products/genix/genix-gx11c03.jpg',
                'order' => 30,
            ],
            [
                'category_key' => 'cauliflower',
                'sku' => 'GX12C01',
                'name_en' => 'Cauliflower - GX12C01',
                'name_ar' => 'القرنبيط - GX12C01',
                'slug' => 'genix-gx12c01',
                'description_en' => '- Excellent adaptability, Vigorous Plant with Excellent Self Covering
- Uniform, Large White Dome Curd Shape
- Good Heat Tolerance & Attractive Market Appearance
- Average Curd Weight 1.5-2 Kg
- Suitable for Spring & Summer Segments',
                'description_ar' => '- تأقلم ممتاز، نبات قوي النمو بتغطية ذاتية ممتازة
- نورة زهرية بيضاء قبية كبيرة متجانسة الشكل
- تحمل جيد للحرارة ومظهر تسويقي جذاب
- متوسط وزن النورة الزهرية 1.5-2 كغم
- مناسب لموسمي الربيع والصيف',
                'image' => 'products/genix/genix-gx12c01.jpg',
                'order' => 40,
            ],
            [
                'category_key' => 'cauliflower',
                'sku' => 'GX12C02',
                'name_en' => 'Cauliflower - GX12C02',
                'name_ar' => 'القرنبيط - GX12C02',
                'slug' => 'genix-gx12c02',
                'description_en' => '- Strong plant with good leaf covers.
- Early variety.
- Firm white dome shaped heads, uniform, large 1-1.5kg
- High quality, with excellent coverage.
- For Fresh market or industry.',
                'description_ar' => '- نبات قوي بتغطية ورقية جيدة.
- صنف مبكر.
- رؤوس بيضاء ثابتة قبية الشكل، متجانسة، بوزن كبير 1-1.5 كغم
- جودة عالية، بتغطية ممتازة.
- للسوق الطازجة أو الصناعة.',
                'image' => 'products/genix/genix-gx12c02.jpg',
                'order' => 50,
            ],
            [
                'category_key' => 'cucumber-greenhouse',
                'sku' => 'GX14C01',
                'name_en' => 'Cucumber (Greenhouse) - GX14C01',
                'name_ar' => 'الخيار (بيوت محمية) - GX14C01',
                'slug' => 'genix-gx14c01',
                'description_en' => '- Greenhouse Cucumber
- Vigorous Plant & Good Leaf Cover
- Medium Green Glossy Fruit
- 2 to 3 Fruits on Main Node
- Average Fruit Size 18 x 3 cm
- Suitable for Spring & Summer Segment Only',
                'description_ar' => '- خيار بيوت محمية
- نبات قوي النمو بتغطية ورقية جيدة
- ثمرة خضراء متوسطة لامعة
- من 2 إلى 3 ثمار على العقدة الرئيسية
- متوسط حجم الثمرة 18 x 3 سم
- مناسب لموسمي الربيع والصيف فقط',
                'image' => 'products/genix/genix-gx14c01.jpg',
                'order' => 60,
            ],
            [
                'category_key' => 'cucumber-greenhouse',
                'sku' => 'GX14C02',
                'name_en' => 'Cucumber (Greenhouse) - GX14C02',
                'name_ar' => 'الخيار (بيوت محمية) - GX14C02',
                'slug' => 'genix-gx14c02',
                'description_en' => '- Greenhouse Cucumber
- Moderate Plant Growth with Good Leaf Cover
- Short Internodes With 2 to 3 Fruits On Main Node
- Glossy Ribbed Medium Green Fruit Color
- Average Fruit Size 16 x 3 cm
- Suitable for Spring, Summer & Autumn Segments',
                'description_ar' => '- خيار بيوت محمية
- نمو نباتي معتدل بتغطية ورقية جيدة
- سلاميات قصيرة مع 2 إلى 3 ثمار على العقدة الرئيسية
- لون ثمرة أخضر متوسط لامع مضلّع
- متوسط حجم الثمرة 16 x 3 سم
- مناسب لمواسم الربيع والصيف والخريف',
                'image' => 'products/genix/genix-gx14c02.jpg',
                'order' => 70,
            ],
            [
                'category_key' => 'cucumber-open-field',
                'sku' => 'GX14C03',
                'name_en' => 'Cucumber (Open Field) - GX14C03',
                'name_ar' => 'الخيار (حقل مفتوح) - GX14C03',
                'slug' => 'genix-gx14c03',
                'description_en' => '- Open Field Cucumber
- Strong Vigorous Plant with Good Leaf Cover.
- Medium Green Glossy Fruit, Medium Ribbing
- Average Fruit Length 16 cm
- High Quality, Crunchy Texture
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- خيار حقل مفتوح
- نبات قوي شديد النمو بتغطية ورقية جيدة.
- ثمرة خضراء لامعة متوسطة، تضليع متوسط
- متوسط طول الثمرة 16 سم
- جودة عالية، وقوام مقرمش
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx14c03.jpg',
                'order' => 80,
            ],
            [
                'category_key' => 'cucumber-open-field',
                'sku' => 'GX14C04',
                'name_en' => 'Cucumber (Open Field) - GX14C04',
                'name_ar' => 'الخيار (حقل مفتوح) - GX14C04',
                'slug' => 'genix-gx14c04',
                'description_en' => '- Open Field Cucumber
- Vigorous Plant with Good Leaf Cover
- Medium Green Glossy Fruits
- High Yielding, Good Quality
- Medium Ribbs, Short Internodes
- Average Fruit Length 18 cm
- Suitable for Spring Segment',
                'description_ar' => '- خيار حقل مفتوح
- نبات قوي النمو بتغطية ورقية جيدة.
- ثمار خضراء متوسطة لامعة
- عالي الإنتاجية، بجودة جيدة
- تضليع متوسط، سلاميات قصيرة
- متوسط طول الثمرة 18 سم
- مناسب لموسم الربيع',
                'image' => 'products/genix/genix-gx14c04.jpg',
                'order' => 90,
            ],
            [
                'category_key' => 'eggplant',
                'sku' => 'GX20E01',
                'name_en' => 'Eggplant - GX20E01',
                'name_ar' => 'الباذنجان - GX20E01',
                'slug' => 'genix-gx20e01',
                'description_en' => '- Classic Dark black Eggplant.
- The flesh very firm.
- High yielding for open field and Green houses
- Suitable for all-year around.',
                'description_ar' => '- باذنجان أسود داكن كلاسيكي.
- اللحم صلب جداً.
- عالي الإنتاجية للحقل المفتوح والبيوت المحمية
- مناسب لجميع فصول السنة.',
                'image' => 'products/genix/genix-gx20e01.jpg',
                'order' => 100,
            ],
            [
                'category_key' => 'eggplant',
                'sku' => 'GX20E02',
                'name_en' => 'Eggplant - GX20E02',
                'name_ar' => 'الباذنجان - GX20E02',
                'slug' => 'genix-gx20e02',
                'description_en' => '- Vigorous plant.
- Cylindrical "Slim" Dark Black fruits
- Open field growing
- Cylindrical shape with length around 15 - 18 cm.
- The average weight is 170 gm.
- Adapted for all around the year in main season.',
                'description_ar' => '- نبات قوي النمو.
- ثمار أسطوانية نحيلة داكنة اللون تقريباً أسود
- زراعة في الحقل المفتوح
- شكل أسطواني بطول يتراوح بين 15 و18 سم تقريباً.
- متوسط الوزن 170 غم
- متأقلم على مدار العام في الموسم الرئيسي.',
                'image' => 'products/genix/genix-gx20e02.jpg',
                'order' => 110,
            ],
            [
                'category_key' => 'eggplant',
                'sku' => 'GX20E03',
                'name_en' => 'Eggplant - GX20E03',
                'name_ar' => 'الباذنجان - GX20E03',
                'slug' => 'genix-gx20e03',
                'description_en' => '- Strong Plant & Good Leaf Size
- Early Picking, Glossy Fruit
- Very Good Fruit Setting
- Elongated Globular Fruit Shape
- Average Fruit Weight 500 g
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- نبات قوي بحجم أوراق جيد
- قطاف مبكر، ثمرة لامعة
- عقد ثمار جيد جداً
- ثمرة كروية ممدودة الشكل
- متوسط وزن الثمرة 500 غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx20e03.jpg',
                'order' => 120,
            ],
            [
                'category_key' => 'lettuce',
                'sku' => 'GX21L01',
                'name_en' => 'Lettuce - GX21L01',
                'name_ar' => 'الخس - GX21L01',
                'slug' => 'genix-gx21l01',
                'description_en' => '- Medium to Dark Green Mosaically Indexed Leaves
- Concentrated Harvest, Heat Tolerant
- Romaine Type, Uniform Maturity
- Wide Crown, Large Sized Head, Strong Root System
- Suitable for Autumn Segment.',
                'description_ar' => '- أوراق خضراء متوسطة إلى داكنة بنقشة موزاييك
- حصاد مركّز، متحمل للحرارة
- نوع الخس الروماني، نضج متجانس
- تاج عريض، رأس كبير الحجم، مجموع جذري قوي
- مناسب لموسم الخريف.',
                'image' => 'products/genix/genix-gx21l01.jpg',
                'order' => 130,
            ],
            [
                'category_key' => 'lettuce',
                'sku' => 'GX21L02',
                'name_en' => 'Lettuce - GX21L02',
                'name_ar' => 'الخس - GX21L02',
                'slug' => 'genix-gx21l02',
                'description_en' => '- Very good resistance to bolting.
- Good heat tolerant
- Strong upright growth
- Compact high quality heads.
- Suitable for summer season.',
                'description_ar' => '- مقاومة جيدة جداً للإزهار المبكر.
- متحمل جيد للحرارة
- نمو قوي منتصب
- رؤوس مدمجة عالية الجودة.
- مناسب لموسم الصيف.',
                'image' => 'products/genix/genix-gx21l02.jpg',
                'order' => 140,
            ],
            [
                'category_key' => 'melon',
                'sku' => 'GX16M01',
                'name_en' => 'Melon - GX16M01',
                'name_ar' => 'الشمام - GX16M01',
                'slug' => 'genix-gx16m01',
                'description_en' => '- Galia Type Melon.
- High yielding, medium-early variety
- Strong vegetation, excellent leave cover and good attachment until harvest.
- Attractive fruit, firm and consistent.
- Flesh color greenish cream with a small cavity size.
- Sweet and distinctive taste.
- Round shape, average weight of 3 to 4.5 kg.',
                'description_ar' => '- شمام من نوع غاليا.
- صنف متوسط التبكير عالي الإنتاجية
- نمو خضري قوي، تغطية ورقية ممتازة وتماسك جيد للثمار حتى الحصاد.
- ثمرة جذابة، صلبة وثابتة الشكل.
- لون اللحم أخضر كريمي بتجويف بذور صغير.
- طعم حلو ومميز.
- شكل مستدير، بمتوسط وزن يتراوح بين 3 و4.5 كغم.',
                'image' => 'products/genix/genix-gx16m01.jpg',
                'order' => 150,
            ],
            [
                'category_key' => 'melon',
                'sku' => 'GX16M02',
                'name_en' => 'Melon - GX16M02',
                'name_ar' => 'الشمام - GX16M02',
                'slug' => 'genix-gx16m02',
                'description_en' => '- Galia Type Melon
- Good Plant Vigor & Leaf Cover
- Uniform Fruits, High Set
- Oval Uniform Fruit Shape
- Golden Yellow Skin, Creamy Flesh with Compact Seed cavity.
- Average Fruit Weight 1.5 - 2 Kg',
                'description_ar' => '- شمام من نوع غاليا.
- قوة نمو نباتي جيدة وتغطية ورقية
- ثمار متجانسة، عقد عالٍ
- ثمرة بيضاوية الشكل متجانسة
- قشرة صفراء ذهبية، ولحم كريمي بتجويف بذور مدمج.
- متوسط وزن الثمرة 1.5 - 2 كغم',
                'image' => 'products/genix/genix-gx16m02.jpg',
                'order' => 160,
            ],
            [
                'category_key' => 'melon',
                'sku' => 'GX16M03',
                'name_en' => 'Melon - GX16M03',
                'name_ar' => 'الشمام - GX16M03',
                'slug' => 'genix-gx16m03',
                'description_en' => '- Ananas Type Melon
- Strong Vines & Good Leaf Cover
- Good Heat Setting, Firm Fruit, Excellent Shelf Life
- Elongated Fruit Shape
- Orange Flesh & Compact Seed Cavity
- Average Fruit Weight 2.5 - 3.5 Kg
- Suitable for Spring & Summer Segments',
                'description_ar' => '- شمام من نوع أناناس
- متسلقات قوية بتغطية ورقية جيدة
- عقد جيد تحت الحرارة، ثمرة صلبة، وفترة صلاحية ممتازة
- ثمرة ممدودة الشكل
- لحم برتقالي بتجويف بذور مدمج
- متوسط وزن الثمرة 2.5 - 3.5 كغم
- مناسب لموسمي الربيع والصيف',
                'image' => 'products/genix/genix-gx16m03.jpg',
                'order' => 170,
            ],
            [
                'category_key' => 'melon',
                'sku' => 'GX16M04',
                'name_en' => 'Melon - GX16M04',
                'name_ar' => 'الشمام - GX16M04',
                'slug' => 'genix-gx16m04',
                'description_en' => '- Ananas Type Melon
- Vigorous Plant with Good Leaf Cover
- Firm Fruit, Non-Slipping, Sweet Taste
- Uniform Oval Fruit Shape
- Attractive Netting & Skin Color
- Average Fruit Weight 1.5 - 2.5 Kg
- Suitable for Spring & Summer Segments',
                'description_ar' => '- شمام من نوع أناناس
- نبات قوي النمو بتغطية ورقية جيدة.
- ثمرة صلبة، غير قابلة للانزلاق، طعم حلو
- ثمرة بيضاوية الشكل متجانسة
- تعريق وقشرة بلون جذاب
- متوسط وزن الثمرة 1.5 - 2.5 كغم
- مناسب لموسمي الربيع والصيف',
                'image' => 'products/genix/genix-gx16m04.jpg',
                'order' => 180,
            ],
            [
                'category_key' => 'melon',
                'sku' => 'GX16M05',
                'name_en' => 'Melon - GX16M05',
                'name_ar' => 'الشمام - GX16M05',
                'slug' => 'genix-gx16m05',
                'description_en' => '- Yellow Canary Melon
- Medium Early Variety, disease tolerant
- Medium elliptic Fruit Shape
- Vigorous Plant and highly uniform fruit
- Yellow Skin with White Flesh Color
- Average fruit weight: 3-4.5 kg
- Very high fruit setting',
                'description_ar' => '- شمام كناري أصفر
- صنف متوسط التبكير، متحمل للأمراض
- ثمرة إهليلجية متوسطة الشكل
- نبات قوي النمو وثمار متجانسة جداً
- قشرة صفراء بلحم أبيض اللون
- متوسط وزن الثمرة 3-4.5 كغم
- عقد ثمار عالٍ جداً',
                'image' => 'products/genix/genix-gx16m05.jpg',
                'order' => 190,
            ],
            [
                'category_key' => 'melon',
                'sku' => 'GX16M06',
                'name_en' => 'Melon - GX16M06',
                'name_ar' => 'الشمام - GX16M06',
                'slug' => 'genix-gx16m06',
                'description_en' => '- Italian Type Melon (Cantaloupe)
- Strong vigour with good coverage
- Oval Uniform Fruit Shape
- Average fruit weight 2.5-4 kg
- Deep Orange Flesh Color with good taste
- Very high fruit setting',
                'description_ar' => '- شمام إيطالي (كانتالوب)
- قوة نمو عالية بتغطية جيدة
- ثمرة بيضاوية الشكل متجانسة
- متوسط وزن الثمرة 2.5-4 كغم
- لون لحم برتقالي داكن بطعم جيد.
- عقد ثمار عالٍ جداً',
                'image' => 'products/genix/genix-gx16m06.jpg',
                'order' => 200,
            ],
            [
                'category_key' => 'onion',
                'sku' => 'TEXAS EARLY GRANO',
                'name_en' => 'Onion - TEXAS EARLY GRANO',
                'name_ar' => 'البصل - TEXAS EARLY GRANO',
                'slug' => 'genix-texas-early-grano',
                'description_en' => '- This widely used short day variety is a classic heirloom onion that has been going strong for generations around the world.
- Mild and pleasing taste,
- Vegetables size as large as a pound a piece.',
                'description_ar' => '- هذا الصنف واسع الاستخدام من أصناف النهار القصير هو بصل تراثي كلاسيكي معروف منذ أجيال حول العالم.
- طعم معتدل ومستحب،
- حجم الثمرة يصل وزنه إلى نصف كيلوغرام تقريباً للثمرة الواحدة.',
                'image' => 'products/genix/genix-texas-early-grano.jpg',
                'order' => 210,
            ],
            [
                'category_key' => 'onion',
                'sku' => 'EARLY WHITE GRANO',
                'name_en' => 'Onion - EARLY WHITE GRANO',
                'name_ar' => 'البصل - EARLY WHITE GRANO',
                'slug' => 'genix-early-white-grano',
                'description_en' => '- Classic white onion with low pungency
- Great yield with large bulbs
- Prefers full sun exposure
- Mild flavored white onions.',
                'description_ar' => '- بصل أبيض كلاسيكي بحدة منخفضة
- إنتاجية عالية مع أبصال كبيرة الحجم
- يُفضّل التعرض الكامل لأشعة الشمس
- بصل أبيض معتدل النكهة',
                'image' => 'products/genix/genix-early-white-grano.jpg',
                'order' => 220,
            ],
            [
                'category_key' => 'onion',
                'sku' => 'GX19N01',
                'name_en' => 'Onion - GX19N01',
                'name_ar' => 'البصل - GX19N01',
                'slug' => 'genix-gx19n01',
                'description_en' => '- Hybrid Yellow
- Over Winter Short Day Variety
- Early Maturity with Excellent Taste
- Thick Flat to Flattened Globe Bulb Shape
- Uniform Jumbo to Large Fruit,
- Early Variety, High Yielding
- Recommended for Direct Sowing and Transplanting
- For Fresh Market Consumption & long storage',
                'description_ar' => '- هجين أصفر
- صنف نهار قصير يزرع خلال الشتاء
- نضج مبكر بطعم ممتاز
- بصلة بشكل كروي مسطح إلى مفلطح
- ثمرة متجانسة كبيرة إلى كبيرة جداً الحجم،
- صنف مبكر عالي الإنتاجية
- يُنصح بالزراعة المباشرة أو الشتل
- للاستهلاك الطازج والتخزين الطويل',
                'image' => 'products/genix/genix-gx19n01.jpg',
                'order' => 230,
            ],
            [
                'category_key' => 'onion',
                'sku' => 'GX19N02',
                'name_en' => 'Onion - GX19N02',
                'name_ar' => 'البصل - GX19N02',
                'slug' => 'genix-gx19n02',
                'description_en' => '- Hybrid Yellow Onion
- Medium Maturity cycle short Day
- Good vigor plant
- Round Bulb of large size, thin neck;
- For fresh market / long storage
- High yield, bronze color, very firm and good skin protection, tolerant to disease',
                'description_ar' => '- بصل أصفر هجين
- دورة نضج متوسطة، نهار قصير
- نبات ذو قوة نمو جيدة
- بصلة مستديرة كبيرة الحجم، رقبة رفيعة؛
- للسوق الطازجة أو التخزين الطويل
- إنتاجية عالية، لون برونزي، صلب جداً وحماية جيدة للقشرة، ومتحمل للأمراض',
                'image' => 'products/genix/genix-gx19n02.jpg',
                'order' => 240,
            ],
            [
                'category_key' => 'onion',
                'sku' => 'GX19N03',
                'name_en' => 'Onion - GX19N03',
                'name_ar' => 'البصل - GX19N03',
                'slug' => 'genix-gx19n03',
                'description_en' => '- Overwintering Red Variety
- Red skin color.
- Early Maturity.  Vigorous Variety
- Round-globe Bulb Shape; bunching.
- Medium Bulb size.
- Storage Ability: upto 3 months
- Remarks: Variety for early harvest. Low pungency. Also suitable for bunching',
                'description_ar' => '- صنف أحمر يزرع خلال الشتاء
- لون قشرة أحمر.
- نضج مبكر، صنف قوي النمو
- بصلة بشكل كروي مستدير؛ للحزم.
- حجم بصلة متوسط
- قدرة تخزين تصل إلى 3 أشهر
- ملاحظات: صنف للحصاد المبكر، حدة منخفضة، ومناسب أيضاً للحزم',
                'image' => 'products/genix/genix-gx19n03.jpg',
                'order' => 250,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P01',
                'name_en' => 'Pepper - GX17P01',
                'name_ar' => 'الفلفل - GX17P01',
                'slug' => 'genix-gx17p01',
                'description_en' => '- Hot Pepper
- Well Balanced Plant With Good Large Leaves
- High Yield, High Fruit Quality
- Thick Firm Flesh & Strong Pungency
- Green Fruit Turns Into Deep Red at Full Maturity
- Average Fruit Size 20 x 2 cm
- Greenhouse & Open Field
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- فلفل حار
- نبات متوازن بأوراق كبيرة جيدة
- إنتاجية عالية، جودة ثمار عالية
- لحم سميك وصلب، وحدة (حرارة) قوية
- الثمرة الخضراء تتحول إلى أحمر داكن عند النضج الكامل
- متوسط حجم الثمرة 20 x 2 سم
- بيوت محمية وحقل مفتوح
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx17p01.jpg',
                'order' => 260,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P02',
                'name_en' => 'Pepper - GX17P02',
                'name_ar' => 'الفلفل - GX17P02',
                'slug' => 'genix-gx17p02',
                'description_en' => '- Hot Pepper
- Strong & Vigorous Plant
- Pungent, Suitable For Green House & Open Field
- Medium Early Production
- Green Color Turns Red at Full Maturity
- Average Fruit Size 17 x 3.5 cm
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- فلفل حار
- نبات قوي وشديد النمو
- حاد النكهة، مناسب للبيوت المحمية والحقل المفتوح
- إنتاج متوسط التبكير
- لون أخضر يتحول إلى أحمر عند النضج الكامل
- متوسط حجم الثمرة 17 x 3.5 سم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx17p02.jpg',
                'order' => 270,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P03',
                'name_en' => 'Pepper - GX17P03',
                'name_ar' => 'الفلفل - GX17P03',
                'slug' => 'genix-gx17p03',
                'description_en' => '- Hot Pepper
- Strong Plant with Good Leaf Cover
- Uniform Fruit, High Setting
- Greenhouse & Open Field
- Dark Green Fruit Color Turns into Deep Red at Full Maturity
- Firm and Thick Walls, Disease Tolerant
- Average Fruit Size 17 x 3 cm
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- فلفل حار
- نبات قوي بتغطية ورقية جيدة.
- ثمرة متجانسة، عقد ثمار عالٍ
- بيوت محمية وحقل مفتوح
- لون الثمرة أخضر داكن يتحول إلى أحمر داكن عند النضج الكامل
- جدران سميكة وصلبة، ومتحمل للأمراض
- متوسط حجم الثمرة 17 x 3 سم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx17p03.jpg',
                'order' => 280,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P04',
                'name_en' => 'Pepper - GX17P04',
                'name_ar' => 'الفلفل - GX17P04',
                'slug' => 'genix-gx17p04',
                'description_en' => '- Hot Pepper
- Vigorous Plant & Long Fruits
- Dark green color, turns to red at full maturity
- Fruit Size: 16.5cm x 2.2cm
- Very High Fruit Setting
- Recommended for Open Field and Greenhouse. Cold tolerant variety',
                'description_ar' => '- فلفل حار
- نبات قوي النمو وثمار طويلة
- لون أخضر داكن، يتحول إلى أحمر عند النضج الكامل
- حجم الثمرة: 16.5سم x 2.2سم
- عقد ثمار عالٍ جداً
- يُنصح به للحقل المفتوح والبيوت المحمية، صنف متحمل للبرودة',
                'image' => 'products/genix/genix-gx17p04.jpg',
                'order' => 290,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P05',
                'name_en' => 'Pepper - GX17P05',
                'name_ar' => 'الفلفل - GX17P05',
                'slug' => 'genix-gx17p05',
                'description_en' => '- Hot Pepper
- Vigorous Plant Banana type
- Conical Fruit shape
- Light Creamy Fruit Color
- Average fruit weight: 90gr
- Fruit Size: 25cm x 4.5cm
- Fruit Setting: High
- Recommended for Open Field and Greenhouse. Cold tolerant variety',
                'description_ar' => '- فلفل حار
- نبات قوي النمو - نوع الموزي
- ثمرة مخروطية الشكل
- لون الثمرة كريمي فاتح
- متوسط وزن الثمرة 90غم
- حجم الثمرة: 25سم x 4.5سم
- عقد الثمار: مرتفع
- يُنصح به للحقل المفتوح والبيوت المحمية، صنف متحمل للبرودة',
                'image' => 'products/genix/genix-gx17p05.jpg',
                'order' => 300,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P06',
                'name_en' => 'Pepper - GX17P06',
                'name_ar' => 'الفلفل - GX17P06',
                'slug' => 'genix-gx17p06',
                'description_en' => '- Hot Pepper
- Vigorous plant, High Yielding variety .
- High Pungency.
- Thick fruit wall , the best for Pickles
- Adapted for Open Field
- Suitable for all year around',
                'description_ar' => '- فلفل حار
- نبات قوي النمو، صنف عالي الإنتاجية
- حدة عالية.
- جدار ثمرة سميك، الأفضل للمخللات
- متأقلم مع الحقل المفتوح
- مناسب لجميع فصول السنة',
                'image' => 'products/genix/genix-gx17p06.jpg',
                'order' => 310,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P07',
                'name_en' => 'Pepper - GX17P07',
                'name_ar' => 'الفلفل - GX17P07',
                'slug' => 'genix-gx17p07',
                'description_en' => '- Sweet Pepper
- Vigorous Plant with Good Cover
- High Setting, Attractive Color, Disease Tolerant
- Blocky Pepper with Thick Flesh
- Glossy Dark Green Fruit Color
- Uniform Fruit Shape Mostly 4 Lobes
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- فلفل حلو
- نبات قوي النمو بتغطية جيدة
- عقد ثمار عالٍ، لون جذاب، متحمل للأمراض
- فلفل بشكل مكعب ولحم سميك
- لون الثمرة أخضر داكن لامع
- ثمرة متجانسة الشكل بأربعة فصوص غالباً
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx17p07.jpg',
                'order' => 320,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P08',
                'name_en' => 'Pepper - GX17P08',
                'name_ar' => 'الفلفل - GX17P08',
                'slug' => 'genix-gx17p08',
                'description_en' => '- Sweet Pepper
- High production with outstanding fruit quality.
- Uniform Shape Fruits, heavy and firm, green color to red at full maturity.
- High yielding variety.
- Strong growth and open plant habit.
- A leading variety producing export quality peppers.
- Suitable for green house culture and open field.',
                'description_ar' => '- فلفل حلو
- إنتاجية عالية بجودة ثمار متميزة.
- ثمار متجانسة الشكل، ثقيلة وصلبة، لونها أخضر يتحول إلى أحمر عند النضج الكامل.
- صنف عالي الإنتاجية.
- نمو قوي وطبيعة نباتية منفتحة.
- صنف رائد ينتج فلفلاً بجودة تصديرية.
- مناسب للزراعة في البيوت المحمية والحقل المفتوح.',
                'image' => 'products/genix/genix-gx17p08.jpg',
                'order' => 330,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P09',
                'name_en' => 'Pepper - GX17P09',
                'name_ar' => 'الفلفل - GX17P09',
                'slug' => 'genix-gx17p09',
                'description_en' => '- Sweet Pepper
- Strong & Vigorous Plant with Good Fruit Cover
- Long Production Cycle, Cold & Disease Tolerant
- Corno-Marconi Fruit Type. Conical Shape
- Green Fruit Color Turns to Deep Red at Maturity
- Average Fruit Length 19 x 5 cm
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- فلفل حلو
- نبات قوي وشديد النمو بتغطية جيدة للثمار
- دورة إنتاج طويلة، ومتحمل للبرودة والأمراض
- نوع الثمرة كورنو-ماركوني، شكل مخروطي
- لون الثمرة أخضر يتحول إلى أحمر داكن عند النضج
- متوسط طول الثمرة 19 x 5 سم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx17p09.jpg',
                'order' => 340,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P10',
                'name_en' => 'Pepper - GX17P10',
                'name_ar' => 'الفلفل - GX17P10',
                'slug' => 'genix-gx17p10',
                'description_en' => '- Sweet Pepper
- High yeilding variety, attractive features
- Suitable for greenhouse and open field.
- Long harvesting cycle, very mild pungency.
- Conical Dark green fruit having thick & strong wall
- Agerage fruit length from 20 cm to 30 cm
- Tolerant to P.M.',
                'description_ar' => '- فلفل حلو
- صنف عالي الإنتاجية، بخصائص جذابة
- مناسب للبيوت المحمية والحقل المفتوح.
- دورة حصاد طويلة، حدة خفيفة جداً.
- ثمرة مخروطية داكنة الخضرة بجدار سميك وقوي
- متوسط طول الثمرة من 20 إلى 30 سم
- متحمل للبياض الدقيقي',
                'image' => 'products/genix/genix-gx17p10.jpg',
                'order' => 350,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P11',
                'name_en' => 'Pepper - GX17P11',
                'name_ar' => 'الفلفل - GX17P11',
                'slug' => 'genix-gx17p11',
                'description_en' => '- Sweet Pepper
- Vigorous Plant with Good Fruit Cover
- Good Setting, Attractive Fruit Quality
- Half Long to Blocky Type with Medium Flesh Thickness
- Medium Green Color Turns Into Deep Red At Maturity
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- فلفل حلو
- نبات قوي النمو بتغطية جيدة للثمار
- عقد ثمار جيد، وجودة ثمرة جذابة
- نوع من نصف مستطيل إلى مكعب بسماكة لحم متوسطة
- لون أخضر متوسط يتحول إلى أحمر داكن عند النضج
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx17p11.jpg',
                'order' => 360,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'GX17P12',
                'name_en' => 'Pepper - GX17P12',
                'name_ar' => 'الفلفل - GX17P12',
                'slug' => 'genix-gx17p12',
                'description_en' => '- Sweet Pepper
- Compact Vegetation, Mid Early Picking.
- High Quality Fruits, Excellent Firmness.
- Suitable for greenhouse & open field.
- Average Fruit size 10x8 cm, mostly with 4 lobes.
- Turns from green to yellow at full maturity.
- Suitable for spring & autumn segments.',
                'description_ar' => '- فلفل حلو
- نمو خضري مدمج، قطاف متوسط التبكير.
- ثمار عالية الجودة، وصلابة ممتازة.
- مناسب للبيوت المحمية والحقل المفتوح.
- متوسط حجم الثمرة 10x8 سم , mostly مع 4 lobes
- يتحول من الأخضر إلى الأصفر عند النضج الكامل.
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx17p12.jpg',
                'order' => 370,
            ],
            [
                'category_key' => 'pepper',
                'sku' => 'CALIFORNIA WONDER',
                'name_en' => 'Pepper - CALIFORNIA WONDER',
                'name_ar' => 'الفلفل - CALIFORNIA WONDER',
                'slug' => 'genix-california-wonder',
                'description_en' => '- Heirloom California Wonder
- California Wonder is the classic sweet bell pepper. Familiar to all vegetable gardeners for ages,
- Suitable for all year round.
- Widely adapted
- Produces well formed, juicy, crunchy, large pepper fruits.',
                'description_ar' => '- كاليفورنيا وندر التراثي
- كاليفورنيا وندر هو صنف الفلفل الحلو الكلاسيكي، معروف لدى مزارعي الخضروات منذ زمن طويل،
- مناسب لجميع فصول السنة.
- واسع التأقلم.
- ينتج ثمار فلفل كبيرة، متماسكة الشكل، عصيرية ومقرمشة.',
                'image' => 'products/genix/genix-california-wonder.jpg',
                'order' => 380,
            ],
            [
                'category_key' => 'squash',
                'sku' => 'GX18S01',
                'name_en' => 'Squash - GX18S01',
                'name_ar' => 'الكوسا - GX18S01',
                'slug' => 'genix-gx18s01',
                'description_en' => '- Bulbous type Squash
- Excellent Plant Vigor with Medium Large Leaf Cover
- Consistent Fruit Shape, with Good Flower Attachment, Disease Tolerant
- Standard Green Fruit Color
- Average Fruit Size 11-14 cm
- Suitable for Winter & Early Spring Segments',
                'description_ar' => '- كوسا من النوع الانتفاخي
- قوة نمو نباتي ممتازة بتغطية ورقية متوسطة إلى كبيرة
- شكل ثمرة ثابت، مع تماسك جيد للأزهار، ومتحمل للأمراض
- لون الثمرة أخضر عادي
- متوسط حجم الثمرة 11-14 سم
- مناسب لموسم الشتاء وأوائل الربيع',
                'image' => 'products/genix/genix-gx18s01.jpg',
                'order' => 390,
            ],
            [
                'category_key' => 'squash',
                'sku' => 'GX18S02',
                'name_en' => 'Squash - GX18S02',
                'name_ar' => 'الكوسا - GX18S02',
                'slug' => 'genix-gx18s02',
                'description_en' => '- Bulbous Type Squash
- Excellent Plant Vigor with Good Leaf Cover
- Early Picking, Heat Set, High Yielding, Disease Tolerant
- Very Uniform Fruit Shape with Fine Ribs
- Medium Green Fruit Color
- Average Fruit Size 14 cm
- Suitable for Spring, Summer & Autumn Segments.',
                'description_ar' => '- كوسا من النوع الانتفاخي
- قوة نمو نباتي ممتازة بتغطية ورقية جيدة
- قطاف مبكر، عقد تحت الحرارة، إنتاجية عالية، ومتحمل للأمراض
- ثمرة شديدة التجانس بتضليع ناعم
- لون الثمرة أخضر متوسط
- متوسط حجم الثمرة 14 سم
- مناسب لمواسم الربيع والصيف والخريف',
                'image' => 'products/genix/genix-gx18s02.jpg',
                'order' => 400,
            ],
            [
                'category_key' => 'squash',
                'sku' => 'GX18S03',
                'name_en' => 'Squash - GX18S03',
                'name_ar' => 'الكوسا - GX18S03',
                'slug' => 'genix-gx18s03',
                'description_en' => '- Cylindrical Type Squash
- Strong Plant Growth & Good Leaf Cover
- Easy Picking, High Quality Fruit, Disease Tolerant
- Uniform Cylindrical Fruit Shape
- Medium Dark Green Fruit
- Average Fruit Size 18 cm
- Suitable for Spring & Autumn Segments.',
                'description_ar' => '- كوسا من النوع الأسطواني
- نمو نباتي قوي بتغطية ورقية جيدة
- سهل القطاف، ثمرة عالية الجودة، ومتحمل للأمراض
- ثمرة أسطوانية الشكل متجانسة
- ثمرة خضراء داكنة متوسطة اللون
- متوسط حجم الثمرة 18 سم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx18s03.jpg',
                'order' => 410,
            ],
            [
                'category_key' => 'squash',
                'sku' => 'GX18S04',
                'name_en' => 'Squash - GX18S04',
                'name_ar' => 'الكوسا - GX18S04',
                'slug' => 'genix-gx18s04',
                'description_en' => '- Cylindrical Type Squash
- Vigorous Vegetation, Disease Tolerant
- Remarkable Fruit Quality, Continuous Picking
- Consistent Fruit Shape
- Medium Dark Green Uniform Color
- Fruit Length 18 cm
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- كوسا من النوع الأسطواني
- نمو خضري قوي، متحمل للأمراض
- جودة ثمار ملحوظة، وقطاف مستمر
- شكل ثمرة ثابت
- لون أخضر داكن متوسط ومتجانس
- طول الثمرة 18 سم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx18s04.jpg',
                'order' => 420,
            ],
            [
                'category_key' => 'squash',
                'sku' => 'GX18S05',
                'name_en' => 'Squash - GX18S05',
                'name_ar' => 'الكوسا - GX18S05',
                'slug' => 'genix-gx18s05',
                'description_en' => '- Cylindrical Type Squash
- Strong Vigourous Plant Growth
- High Fruit Setting, Good Cold Tolerance
- Cylindrical Fruit Shape with Medium Green Fruit color
- Fine Ribbing, with Average Fruit Length 17 cm
- Suitable for Spring, Autumn & Winter Segments',
                'description_ar' => '- كوسا من النوع الأسطواني
- نمو نباتي قوي وشديد
- عقد ثمار عالٍ، تحمل جيد للبرودة
- ثمرة أسطوانية الشكل بلون أخضر متوسط
- تضليع ناعم، بمتوسط طول ثمرة 17 سم
- مناسب لمواسم الربيع والخريف والشتاء',
                'image' => 'products/genix/genix-gx18s05.jpg',
                'order' => 430,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T01',
                'name_en' => 'Tomato - GX15T01',
                'name_ar' => 'الطماطم - GX15T01',
                'slug' => 'genix-gx15t01',
                'description_en' => '- Det. Tomato
- Good Fruit Setting, Long Production Cycle
- Good Plant Vigor & Leaf Cover
- Uniform Deep Oblate Fruit Shape
- Average Fruit Weight 300 g
- Suitable for Autumn Segment',
                'description_ar' => '- طماطم قصيرة النمو
- عقد ثمار جيد، ودورة إنتاج طويلة
- قوة نمو نباتي جيدة وتغطية ورقية
- ثمرة بشكل مفلطح عميق متجانس
- متوسط وزن الثمرة 300 غم
- مناسب لموسم الخريف.',
                'image' => 'products/genix/genix-gx15t01.jpg',
                'order' => 440,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T03',
                'name_en' => 'Tomato - GX15T03',
                'name_ar' => 'الطماطم - GX15T03',
                'slug' => 'genix-gx15t03',
                'description_en' => '- Det. Tomato
- Very Strong Plant & Good Leaf Cover
- Excellent Firmness, Long Production Cycle
- Deep Oblate to Globe Fruit Shape & disease tolerant
- Attractive Deep Red Fruit Color
- Average Fruit Weight 225 g
- Suitable for Autumn & Winter Segments',
                'description_ar' => '- طماطم قصيرة النمو
- نبات قوي بتغطية ورقية جيدة
- صلابة ممتازة، دورة إنتاج طويلة
- ثمرة بشكل مفلطح إلى كروي، ومتحملة للأمراض
- لون ثمرة أحمر داكن جذاب
- متوسط وزن الثمرة 225 غم
- مناسب لموسمي الخريف والشتاء',
                'image' => 'products/genix/genix-gx15t03.jpg',
                'order' => 450,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T04',
                'name_en' => 'Tomato - GX15T04',
                'name_ar' => 'الطماطم - GX15T04',
                'slug' => 'genix-gx15t04',
                'description_en' => '- Det Tomato
- Very Strong Plant with Good Leaf Cover
- High Yielding Variety, Distinguished Quality
- Firm Deep Red Fruits.
- Disease tolerant
- Uniform Attractive Red Color
- Average Fruit Weight 220g
- Suitable for Spring & Autumn Segment',
                'description_ar' => '- طماطم قصيرة النمو
- نبات قوي جداً بتغطية ورقية جيدة
- صنف عالي الإنتاجية، بجودة مميزة
- ثمار حمراء داكنة صلبة.
- متحمل للأمراض.
- لون أحمر جذاب متجانس
- متوسط وزن الثمرة 220غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t04.jpg',
                'order' => 460,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T05',
                'name_en' => 'Tomato - GX15T05',
                'name_ar' => 'الطماطم - GX15T05',
                'slug' => 'genix-gx15t05',
                'description_en' => '- Det. Tomato
- Compact & Vigorous Plant with Good Leaf Cover
- Long Production Cycle
- Globe to Deep Oblate Fruit Shape
- Uniform Red Color
- Average Fruit Weight 250 g
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو
- نبات مدمج وقوي النمو بتغطية ورقية جيدة
- دورة إنتاج طويلة
- ثمرة بشكل كروي إلى مفلطح عميق
- لون أحمر متجانس
- متوسط وزن الثمرة 250 غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t05.jpg',
                'order' => 470,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T06',
                'name_en' => 'Tomato - GX15T06',
                'name_ar' => 'الطماطم - GX15T06',
                'slug' => 'genix-gx15t06',
                'description_en' => '- Det. Tomato
- Good Plant Vigor & Leaf Cover
- Extra Early Variety, Good Heat Set
- Attractive Fruit Quality
- Disease tolerant
- Uniform Deep Oblate Fruit Shape
- Average Fruit Weight 180 g
- Suitable for Spring, Summer & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو
- قوة نمو نباتي جيدة وتغطية ورقية
- صنف مبكر جداً، عقد جيد تحت الحرارة
- جودة ثمرة جذابة
- متحمل للأمراض.
- ثمرة بشكل مفلطح عميق متجانس
- متوسط وزن الثمرة 180 غم
- مناسب لمواسم الربيع والصيف والخريف',
                'image' => 'products/genix/genix-gx15t06.jpg',
                'order' => 480,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T07',
                'name_en' => 'Tomato - GX15T07',
                'name_ar' => 'الطماطم - GX15T07',
                'slug' => 'genix-gx15t07',
                'description_en' => '- Det. Tomato
- Vigorous Plant Growth with Good Leaf Cover
- Uniform Fruit Shape with Attractive Red Color
- Average Fruit Weight 180 g with Quality Fruit
- Semi-Determinate Plant Habit, Fits Well Protected Cultivation
- Suitable for Spring & Fall Segments',
                'description_ar' => '- طماطم قصيرة النمو
- نمو نباتي قوي بتغطية ورقية جيدة
- ثمرة متجانسة الشكل بلون أحمر جذاب
- متوسط وزن الثمرة 180 غم مع جودة ثمرة
- نمو نصف محدد، مناسب جيداً للزراعة المحمية
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t07.jpg',
                'order' => 490,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T08',
                'name_en' => 'Tomato - GX15T08',
                'name_ar' => 'الطماطم - GX15T08',
                'slug' => 'genix-gx15t08',
                'description_en' => '- Det. Tomato
- Good Plant Vigor & Leaf Cover
- Unique Disease Tolerance, Consistent Fruit Shape.
- Uniform Elongated Square Fruit
- Consistent Deep Red Fruit Color
- Average Fruit Weight 160 g
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو
- قوة نمو نباتي جيدة وتغطية ورقية
- تحمل فريد للأمراض، وشكل ثمرة ثابت.
- ثمرة مربعة ممدودة متجانسة
- لون ثمرة أحمر داكن ثابت
- متوسط وزن الثمرة 160 غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t08.jpg',
                'order' => 500,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T10',
                'name_en' => 'Tomato - GX15T10',
                'name_ar' => 'الطماطم - GX15T10',
                'slug' => 'genix-gx15t10',
                'description_en' => '- Det. Tomato
- Strong Plant Vigor & Very Good Leaf Cover
- Attractive Red Color, Consistent Fruit Shape
- Very Good Fruit Setting
- Elongated Square Fruit with Red Color
- Average Fruit Weight 150 g
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو
- قوة نمو عالية بتغطية ورقية جيدة جداً
- لون أحمر جذاب، وشكل ثمرة ثابت
- عقد ثمار جيد جداً
- ثمرة مربعة ممدودة بلون أحمر
- متوسط وزن الثمرة 150 غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t10.jpg',
                'order' => 510,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T11',
                'name_en' => 'Tomato - GX15T11',
                'name_ar' => 'الطماطم - GX15T11',
                'slug' => 'genix-gx15t11',
                'description_en' => '- Det. Tomato
- Vigorous Plant Growth with Good Leaf Cover
- High Yielding Potential, Long Shelf Life
- Attractive Deep Red Fruit Color
- Disease tolerant
- Average Fruit Weight 180 g
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو
- نمو نباتي قوي بتغطية ورقية جيدة
- إمكانية إنتاجية عالية، وفترة صلاحية طويلة
- لون ثمرة أحمر داكن جذاب
- متحمل للأمراض.
- متوسط وزن الثمرة 180 غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t11.jpg',
                'order' => 520,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T14',
                'name_en' => 'Tomato - GX15T14',
                'name_ar' => 'الطماطم - GX15T14',
                'slug' => 'genix-gx15t14',
                'description_en' => '- Det. Tomato
- Vigorous Plant with Good Leaf Cover
- Heat Set, Excellent Quality & Productivity
- Square Fruit Shape
- Uniform Firm Fruit with Red Color
- Average Fruit Weight 160 g
- Suitable for Spring, Summer & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو
- نبات قوي النمو بتغطية ورقية جيدة.
- عقد تحت الحرارة، جودة وإنتاجية ممتازتان
- ثمرة مربعة الشكل
- ثمرة صلبة متجانسة بلون أحمر
- متوسط وزن الثمرة 160 غم
- مناسب لمواسم الربيع والصيف والخريف',
                'image' => 'products/genix/genix-gx15t14.jpg',
                'order' => 530,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T17',
                'name_en' => 'Tomato - GX15T17',
                'name_ar' => 'الطماطم - GX15T17',
                'slug' => 'genix-gx15t17',
                'description_en' => '- Det. Tomato Saladette
- Good Plant Vigor & Leaf Cover
- Excellent Firmness, High Yielding
- Very Good Fruit Setting, & Disease Tolerant
- Elongated Square Fruit
- Average Fruit Weight 140 g
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو (سالاديت)
- قوة نمو نباتي جيدة وتغطية ورقية
- صلابة ممتازة، إنتاجية عالية
- عقد ثمار جيد جداً، ومتحمل للأمراض
- ثمرة مربعة ممدودة
- متوسط وزن الثمرة 140 غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t17.jpg',
                'order' => 540,
            ],
            [
                'category_key' => 'tomato',
                'sku' => 'GX15T19',
                'name_en' => 'Tomato - GX15T19',
                'name_ar' => 'الطماطم - GX15T19',
                'slug' => 'genix-gx15t19',
                'description_en' => '- Det. Tomato Fresh Market
- Compact & Vigorous Plant with Good Leaf Cover
- Heat Set, Early Variety
- Globe Fruit Shape with Uniform Red Fruit Color
- Good Tolerance to Disease & Cracking
- Average Fruit Weight 140 g
- Suitable for Spring & Autumn Segments',
                'description_ar' => '- طماطم قصيرة النمو للسوق الطازجة
- نبات مدمج وقوي النمو بتغطية ورقية جيدة
- عقد تحت الحرارة، صنف مبكر
- ثمرة كروية الشكل بلون أحمر متجانس
- تحمل جيد للأمراض والتشقق
- متوسط وزن الثمرة 140 غم
- مناسب لموسمي الربيع والخريف',
                'image' => 'products/genix/genix-gx15t19.jpg',
                'order' => 550,
            ],
            [
                'category_key' => 'watermelon',
                'sku' => 'GX13W01',
                'name_en' => 'Watermelon - GX13W01',
                'name_ar' => 'البطيخ - GX13W01',
                'slug' => 'genix-gx13w01',
                'description_en' => '- Crimson Sweet Watermelon
- Good Vigor & Leaf Cover
- Green Skin Color with Dark Green Stripes
- Crimson Flesh Color, Crispy & Firm
- Big Size Fruit, Uniform Blocky Fruit Shape
- Suitable for Early & Main Segments',
                'description_ar' => '- بطيخ كريمسون سويت
- قوة نمو جيدة وتغطية ورقية
- لون قشرة أخضر بخطوط خضراء داكنة
- لحم بلون قرمزي، مقرمش وصلب
- ثمرة كبيرة الحجم، شكل مكعب متجانس
- مناسب للمواسم المبكرة والرئيسية',
                'image' => 'products/genix/genix-gx13w01.jpg',
                'order' => 560,
            ],
            [
                'category_key' => 'watermelon',
                'sku' => 'GX13W02',
                'name_en' => 'Watermelon - GX13W02',
                'name_ar' => 'البطيخ - GX13W02',
                'slug' => 'genix-gx13w02',
                'description_en' => '- Crimson Sweet Watermelon
- Strong Vines Giving High Fruit Protection
- Round to Blocky Fruit Shape with Glossy Skin
- Crimson Flesh Color, Crispy & Firm
- High Yield, Excellent Quality, Uniform Fruit Shape
- Suitable for Early & Main Segments',
                'description_ar' => '- بطيخ كريمسون سويت
- متسلقات قوية توفر حماية عالية للثمار
- ثمرة بشكل مستدير إلى مكعب بقشرة لامعة
- لحم بلون قرمزي، مقرمش وصلب
- إنتاجية عالية، جودة ممتازة، شكل ثمرة متجانس
- مناسب للمواسم المبكرة والرئيسية',
                'image' => 'products/genix/genix-gx13w02.jpg',
                'order' => 570,
            ],
            [
                'category_key' => 'watermelon',
                'sku' => 'GX13W03',
                'name_en' => 'Watermelon - GX13W03',
                'name_ar' => 'البطيخ - GX13W03',
                'slug' => 'genix-gx13w03',
                'description_en' => '- Sugarbaby watermelon
- Round shaped fruit
- Dark green color with red flesh
- Early variety
- Dinguished crispy taste',
                'description_ar' => '- بطيخ شوجر بيبي
- ثمرة مستديرة الشكل
- لون أخضر داكن بلحم أحمر
- صنف مبكر.
- طعم مقرمش مميز',
                'image' => 'products/genix/genix-gx13w03.jpg',
                'order' => 580,
            ],
            [
                'category_key' => 'watermelon',
                'sku' => 'GX13W04',
                'name_en' => 'Watermelon - GX13W04',
                'name_ar' => 'البطيخ - GX13W04',
                'slug' => 'genix-gx13w04',
                'description_en' => '- Charleston Grey Watermelon
- Strong Vines & Excellent Plant Cover
- Very good Setting, Attractive Skin
- Blocky Oblong Fruit Shape
- Attractive Glossy Skin with Crimson Red Flesh Color
- Suitable for Main Segment',
                'description_ar' => '- بطيخ تشارلستون غراي
- متسلقات قوية وتغطية نباتية ممتازة
- عقد ثمار جيد جداً، وقشرة جذابة
- ثمرة مستطيلة الشكل شبه مكعبة
- قشرة لامعة جذابة بلحم أحمر قرمزي اللون
- مناسب للموسم الرئيسي',
                'image' => 'products/genix/genix-gx13w04.jpg',
                'order' => 590,
            ],
            [
                'category_key' => 'watermelon',
                'sku' => 'GX13W05',
                'name_en' => 'Watermelon - GX13W05',
                'name_ar' => 'البطيخ - GX13W05',
                'slug' => 'genix-gx13w05',
                'description_en' => '- Charleston Grey Watermelon
- Blocky long fruit shape
- Grey color fruit with red flesh
- High fruit setting
- Good taste
- Very early',
                'description_ar' => '- بطيخ تشارلستون غراي
- ثمرة بشكل مكعب مستطيل
- ثمرة رمادية اللون بلحم أحمر
- عقد ثمار عالٍ
- طعم جيد
- مبكر جداً',
                'image' => 'products/genix/genix-gx13w05.jpg',
                'order' => 600,
            ],
        ];

        foreach ($products as $p) {
            Product::updateOrCreate(
                ['slug' => $p['slug']],
                [
                    'product_category_id' => $categoryIds[$p['category_key']] ?? null,
                    'brand' => $brand,
                    'sku' => $p['sku'],
                    'name_en' => $p['name_en'],
                    'name_ar' => $p['name_ar'],
                    'short_description_en' => \Illuminate\Support\Str::limit(str_replace('- ', '', $p['description_en']), 90),
                    'short_description_ar' => \Illuminate\Support\Str::limit(str_replace('- ', '', $p['description_ar']), 90),
                    'description_en' => $p['description_en'],
                    'description_ar' => $p['description_ar'],
                    'image' => $p['image'],
                    'order' => $p['order'],
                    'is_active' => true,
                ]
            );
        }
    }
}