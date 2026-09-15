<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\Page;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Statistic;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        // Pages
        Page::updateOrCreate(['slug' => 'about'], [
            'title_en' => 'About Us', 'title_ar' => 'من نحن',
            'content_en' => "Genix Seeds is a fast-progressing establishment despite being recently founded, but it has emerged to be a leading organization by utilizing the expertise and knowledge of the management, agronomists, technicians, breeders, and marketing teams.\n\nThe Genix team as a whole has a minimum experience of 6 years in seed development, evaluation, and distribution.\n\nAt Genix Seeds we put our utmost effort into providing improved, high quality seeds for your needs. Genix Seeds allocates a great amount — 20% of its sales revenue — for research, development and evaluation, so that the seeds we supply have excellent quality to satisfy every grower.\n\nOur aim is to develop functional hybrids with extra health benefits — hybrids that help maintain your health when you consume those vegetables.\n\nMoreover, recent climate changes have added difficulties to vegetable growing around the globe. We plan to develop varieties with tolerance to fluctuating weather, resistance to various diseases, and high yielding varieties for the benefit of growers.\n\nAt Genix Seeds we work responsibly to protect everyone's health by providing varieties that are easy to grow. We strive to be a company that shares the seeds of life by providing the varieties you need through harmonious cooperation among our research station, seed multiplication department, production department, and quality assurance center.\n\nOur aim is to offer products distinguished by type and taste, and that comply with the requirements which make them suitable for consumers and markets — guaranteeing high standards of product uniformity.\n\nYour continuous trust in Genix Seeds helps us stand by your side and grow together, as always.",
            'content_ar' => "جينكس سيدز مؤسسة سريعة التطور رغم حداثة تأسيسها، إذ برزت كمنظمة رائدة من خلال توظيف خبرة ومعرفة فريق الإدارة والمهندسين الزراعيين والفنيين والمربّين وفرق التسويق.\n\nيمتلك فريق جينكس سيدز ككل خبرة لا تقل عن 6 سنوات في تطوير البذور وتقييمها وتوزيعها.\n\nنبذل في جينكس سيدز قصارى جهدنا لتوفير بذور محسّنة وعالية الجودة تلبي احتياجاتكم. وتخصص جينكس سيدز نسبة كبيرة تبلغ 20% من إيراداتها للبحث والتطوير والتقييم، لضمان أن تكون البذور التي نوفرها بجودة ممتازة ترضي كل مزارع.\n\nهدفنا هو تطوير هجن وظيفية ذات فوائد صحية إضافية، هجن تساعد على الحفاظ على صحتكم عند تناول هذه الخضروات.\n\nعلاوة على ذلك، أضافت التغيرات المناخية الأخيرة بعض الصعوبات في زراعة الخضروات حول العالم. نخطط لتطوير أصناف قادرة على تحمل تقلبات الطقس، ومقاومة لمختلف الأمراض، وذات إنتاجية عالية لمنفعة المزارعين.\n\nنعمل في جينكس سيدز بمسؤولية للحفاظ على صحة الجميع من خلال توفير أصناف سهلة الزراعة. نسعى لأن نكون شركة تشارك بذور الحياة من خلال توفير الأصناف التي تلبي احتياجاتكم عبر تعاون منسجم بين محطة الأبحاث وقسم إكثار البذور وقسم الإنتاج ومركز ضمان الجودة.\n\nهدفنا هو تقديم منتجات متميزة من حيث النوع والطعم، وتتوافق أيضاً مع المتطلبات التي تجعلها مناسبة للمستهلكين والأسواق، بما يضمن أعلى معايير التجانس في المنتج.\n\nثقتكم المستمرة بجينكس سيدز تساعدنا على الوقوف بجانبكم والنمو معاً كما هو الحال دائماً.",
            'is_active' => true,
        ]);

        // Services
        $services = [
            ['title_en' => 'Smart Irrigation Systems', 'title_ar' => 'أنظمة الري الذكية', 'icon' => 'bi-droplet-fill'],
            ['title_en' => 'Soil & Crop Consulting', 'title_ar' => 'استشارات التربة والمحاصيل', 'icon' => 'bi-flower1'],
            ['title_en' => 'Precision Farming', 'title_ar' => 'الزراعة الدقيقة', 'icon' => 'bi-cpu'],
            ['title_en' => 'Organic Fertilization', 'title_ar' => 'التسميد العضوي', 'icon' => 'bi-recycle'],
            ['title_en' => 'Greenhouse Solutions', 'title_ar' => 'حلول البيوت المحمية', 'icon' => 'bi-house-heart'],
            ['title_en' => 'Farm Equipment Rental', 'title_ar' => 'تأجير المعدات الزراعية', 'icon' => 'bi-truck'],
        ];
        foreach ($services as $i => $s) {
            Service::updateOrCreate(['slug' => \Illuminate\Support\Str::slug($s['title_en'])], array_merge($s, [
                'slug' => \Illuminate\Support\Str::slug($s['title_en']),
                'short_description_en' => 'Professional, reliable, and sustainable solutions tailored to your farm.',
                'short_description_ar' => 'حلول احترافية وموثوقة ومستدامة مصممة خصيصاً لمزرعتك.',
                'description_en' => 'We combine decades of agronomic expertise with modern technology to deliver measurable results for our clients, ensuring higher yields and long-term soil health.',
                'description_ar' => 'نجمع بين عقود من الخبرة الزراعية والتكنولوجيا الحديثة لتحقيق نتائج ملموسة لعملائنا.',
                'order' => $i, 'is_featured' => true, 'is_active' => true,
            ]));
        }

        // NOTE: Product categories & products are NOT seeded here anymore.
        // The real Genix Seeds catalog is seeded by GenixProductsSeeder
        // (run right after this seeder from DatabaseSeeder), using the
        // actual company data.

        // News
        $newsCat = NewsCategory::updateOrCreate(['slug' => 'company-news'], ['name_en' => 'Company News', 'name_ar' => 'أخبار الشركة', 'slug' => 'company-news']);
        $admin = User::first();
        $articles = [
            'Genix Seeds Wins Sustainable Agriculture Award 2026',
            'New Smart Irrigation Technology Launched',
            'Partnership Announcement with Regional Farmers Union',
            'Expanding Operations to Three New Regions',
        ];
        foreach ($articles as $i => $title) {
            News::updateOrCreate(['slug' => \Illuminate\Support\Str::slug($title)], [
                'news_category_id' => $newsCat->id, 'author_id' => $admin?->id,
                'title_en' => $title, 'title_ar' => $title, 'slug' => \Illuminate\Support\Str::slug($title),
                'excerpt_en' => 'Read about our latest milestone and what it means for the future of sustainable agriculture.',
                'excerpt_ar' => 'اقرأ عن أحدث إنجازاتنا وما يعنيه ذلك لمستقبل الزراعة المستدامة.',
                'content_en' => 'Our team continues to push the boundaries of modern agriculture, combining technology and tradition to serve farming communities better. This achievement reflects our long-term commitment to innovation and sustainability.',
                'content_ar' => 'يواصل فريقنا دفع حدود الزراعة الحديثة، من خلال الجمع بين التكنولوجيا والتقاليد لخدمة المجتمعات الزراعية بشكل أفضل.',
                'is_featured' => $i === 0, 'is_published' => true, 'published_at' => now()->subDays($i * 5),
            ]);
        }

        // Statistics
        $stats = [
            ['label_en' => 'Years of Experience', 'label_ar' => 'سنوات الخبرة', 'value' => 6, 'suffix' => '+', 'icon' => 'bi-award'],
            ['label_en' => 'Projects Completed', 'label_ar' => 'المشاريع المنجزة', 'value' => 340, 'suffix' => '+', 'icon' => 'bi-kanban'],
            ['label_en' => 'Happy Clients', 'label_ar' => 'عملاء سعداء', 'value' => 1200, 'suffix' => '+', 'icon' => 'bi-emoji-smile'],
            ['label_en' => 'Hectares Cultivated', 'label_ar' => 'الهكتارات المزروعة', 'value' => 50000, 'suffix' => '+', 'icon' => 'bi-globe2'],
        ];
        foreach ($stats as $i => $s) {
            Statistic::updateOrCreate(['label_en' => $s['label_en']], array_merge($s, ['order' => $i, 'is_active' => true]));
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Ahmed Al-Sayed', 'company' => 'Al-Sayed Farms'],
            ['name' => 'Maria Rodriguez', 'company' => 'GreenFields Co-op'],
            ['name' => 'James Wilson', 'company' => 'Wilson Estates'],
        ];
        foreach ($testimonials as $i => $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], array_merge($t, [
                'position_en' => 'Farm Owner', 'position_ar' => 'مالك مزرعة',
                'message_en' => 'Working with Genix Seeds transformed our yields and efficiency. Their team is professional, responsive and deeply knowledgeable.',
                'message_ar' => 'أدى العمل مع جينكس سيدز إلى تحويل إنتاجيتنا وكفاءتنا. فريقهم محترف ومتجاوب ومتمكن.',
                'rating' => 5, 'order' => $i, 'is_active' => true,
            ]));
        }

        // Partners
        for ($i = 1; $i <= 6; $i++) {
            Partner::updateOrCreate(['name' => "Partner {$i}"], [
                'name' => "Partner {$i}",
                'logo' => 'https://dummyimage.com/160x60/e6f4ea/1b6b39.png&text=' . urlencode("Partner {$i}"),
                'order' => $i, 'is_active' => true,
            ]);
        }
    }
}
