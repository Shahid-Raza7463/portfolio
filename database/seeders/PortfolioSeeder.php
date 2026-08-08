<?php

namespace Database\Seeders;

use App\Models\Portfolio\ContactInfo;
use App\Models\Portfolio\PortfolioCategory;
use App\Models\Portfolio\PortfolioDetail;
use App\Models\Portfolio\PortfolioDetailImage;
use App\Models\Portfolio\PortfolioItem;
use App\Models\Portfolio\PortfolioProfile;
use App\Models\Portfolio\PortfolioStat;
use App\Models\Portfolio\ResumeItem;
use App\Models\Portfolio\ResumeSection;
use App\Models\Portfolio\Service;
use App\Models\Portfolio\Skill;
use App\Models\Portfolio\SocialLink;
use App\Models\Portfolio\Testimonial;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    public function run(): void
    {
        $profile = PortfolioProfile::updateOrCreate(
            ['email' => 'shahidraza7463@gmail.com'],
            [
                'name' => 'Shahid Raza',
                'title' => 'Full Stack Web Developer',
                'typed_items' => 'Full Stack Web Developer, Software Tester, Laravel Developer',
                'profile_image' => 'img/my-profile-img1 (1).png',
                'hero_image' => 'img/home/home1 (1).jpg',
                'about_image' => 'img/my-profile-img (3).png',
                'about_summary' => "Hey there, Name's Shahid Raza and I'm a Full Stack Web Developer,worked @TrakAff as a laravel backend web developer and currently working as laravel backend web developer @Capitall. I'm proficient in working with and implementing backend for web apps using Php, Laravel, Mysql, Ajax, Json, JavaScript, React Js, Node Js, React Native, HTML, CSS, jQuery, Bootstrap. And I enjoy taking on new challenges.I have 2 year of experience in Backend Web Development.",
                'about_description' => 'I am currently expanding my skills in React Native and have recently developed an app called FriendsList. This project has allowed me to explore the fundamentals of mobile app development.',
                'about_extra_description' => 'I have completed nearly 9 projects that have helped me become a skilled professional in Backend web development.',
                'birthday' => '2001-01-01',
                'website' => 'shahid1.infinityfreeapp.com',
                'phone' => '+917488952139',
                'city' => 'Sursand, Sitamarhi, India',
                'age' => 23,
                'degree' => 'Master',
                'freelance' => 'Not Available',
                'skills_intro' => 'Basic knowledge in Php, Laravel, Mysql, Ajax, Json, JavaScript, React Js, Node Js, React Native, HTML, CSS, jQuery, Bootstrap, GitHub, C Programming, MS Power Point, MS Word, MS Excel, Touch Typing.',
                'resume_intro' => 'Passionate and experienced Backend Web Developer with a solid foundation in full-stack development. Skilled in a variety of technologies, from PHP and Laravel to React and Node.js, I am driven to build innovative web solutions that meet and exceed client expectations. My journey in web development has been marked by a commitment to continuous learning and adapting to the latest industry trends. Below is a summary of my professional experience, education, skills, and certifications.',
                'portfolio_intro' => "Welcome to my portfolio. Here you'll find a collection of projects that highlight my expertise in software development and web technologies. Each project demonstrates my dedication to creating effective solutions and my passion for coding.",
                'contact_intro' => 'Below is my contact information. Feel free to reach out to me anytime!',
                'map_embed_url' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.974898484312!2d77.27280758321282!3d28.630514405676287!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfcad2277af7d%3A0xe68dd5cbcfe7d692!2sLaxmi%20Nagar%20Metro%20Station!5e0!3m2!1sen!2sus!4v1725388219908!5m2!1sen!2sus',
            ]
        );

        foreach ([
            ['WhatsApp', 'bi bi-whatsapp', 'https://wa.me/917488952139', 1],
            ['Facebook', 'bi bi-facebook', 'https://www.facebook.com/share/UbuEW2ucYCpR4MBK/?mibextid=qi2Omg', 2],
            ['Instagram', 'bi bi-instagram', '#', 3],
            ['GitHub', 'bi bi-github', 'https://github.com/Shahid-Raza7463?tab=repositories', 4],
            ['LinkedIn', 'bi bi-linkedin', 'https://www.linkedin.com/in/mdshahidraza7886', 5],
        ] as [$name, $icon, $url, $order]) {
            SocialLink::updateOrCreate(
                ['portfolio_profile_id' => $profile->id, 'name' => $name],
                ['icon_class' => $icon, 'url' => $url, 'sort_order' => $order, 'is_active' => true]
            );
        }

        $skills = [
            ['PHP', 80], ['Mysql', 80], ['Json', 90], ['jQuery', 80], ['CSS', 70],
            ['React Js', 60], ['React Native', 70], ['Laravel', 80], ['Ajax', 90],
            ['Javascript', 80], ['HTML', 90], ['Bootstrap', 90], ['Node js', 60],
        ];

        Skill::where('portfolio_profile_id', $profile->id)
            ->whereNotIn('name', collect($skills)->pluck(0)->all())
            ->update(['is_active' => false]);

        foreach ($skills as $index => [$name, $percentage]) {
            Skill::updateOrCreate(
                ['portfolio_profile_id' => $profile->id, 'name' => $name],
                ['percentage' => $percentage, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }

        $objective = ResumeSection::updateOrCreate(
            ['portfolio_profile_id' => $profile->id, 'name' => 'Objective'],
            ['column' => 'left', 'sort_order' => 1, 'is_active' => true]
        );
        ResumeItem::updateOrCreate(
            ['resume_section_id' => $objective->id, 'title' => 'Experienced Backend Web Developer'],
            ['description' => 'Experienced Backend Web Developer with a passion for developing innovative web applications.Skilled in full-stack development,including front-end and back-end technologies.Seeking to use my skills and experience to contribute to a dynamic web development team', 'sort_order' => 1, 'is_active' => true]
        );

        $education = ResumeSection::updateOrCreate(
            ['portfolio_profile_id' => $profile->id, 'name' => 'Education'],
            ['column' => 'left', 'sort_order' => 2, 'is_active' => true]
        );
        foreach ([
            ['Master of Computer Applications (MCA)', '2023 - 2025', 'Chandigarh University, Punjab.', 'Grade: 7.30 CGPA'],
            ['Bachelor of Computer Applications (BCA)', '2019 - 2022', 'International School of Management, Patna, affiliated with Aryabhatta Knowledge University', 'Grade: 7.48 CGPA / 71.06%'],
            ['Intermediate in Science', '2017 - 2019', 'Saryu High School, Sursand, Sitamarhi, affiliated with Bihar School Examination Board', 'Percentage: 71.8%'],
            ['Matriculation (10th)', '2016 - 2017', 'Saryu High School, Sursand, Sitamarhi, affiliated with Bihar School Examination Board', 'Percentage: 64.2%'],
        ] as $index => [$title, $period, $subtitle, $description]) {
            ResumeItem::updateOrCreate(
                ['resume_section_id' => $education->id, 'title' => $title],
                ['period' => $period, 'subtitle' => $subtitle, 'description' => $description, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }

        $technical = ResumeSection::updateOrCreate(
            ['portfolio_profile_id' => $profile->id, 'name' => 'Technical Skills'],
            ['column' => 'left', 'sort_order' => 3, 'is_active' => true]
        );
        ResumeItem::updateOrCreate(
            ['resume_section_id' => $technical->id, 'title' => 'Programming Languages, Tools & Technologies'],
            ['bullets' => ['PHP, Laravel, MySQL, AJAX, JSON, JavaScript, React.js, Node.js, React Native, HTML, CSS, jQuery, Bootstrap, Git, and C Programming.'], 'sort_order' => 1, 'is_active' => true]
        );

        $experience = ResumeSection::updateOrCreate(
            ['portfolio_profile_id' => $profile->id, 'name' => 'Professional Experience'],
            ['column' => 'right', 'sort_order' => 1, 'is_active' => true]
        );
        foreach ([
            ['Laravel Backend Web Developer', '29-09-2023 - Present', 'Capitall India Private Limited, New Delhi', 'https://capitall.io/', ['Developed the Vsa Data Room.', 'Developed Balance confirmation project.', 'Gained significant experience and learned a lot during this period.', 'Acquired basic knowledge in React.js, Node.js and React native.', 'Collaborated with clients to understand their requirements and successfully delivered projects based on their specifications.', 'Gained valuable experience in software testing during this period.']],
            ['Laravel Backend Web Developer Intern', '01-03-2023 - 26-09-2023', 'TrakAff-Affiliate Tracking Software , New Delhi', 'https://www.trakaff.com/', ['Developed the Dynamic Expertaff web application projects.', 'Developed the Dynamic Linktester web application projects.', 'Gained expertise in Php, Laravel, Mysql, Ajax, Json, JavaScript.', 'Successfully applied theoretical knowledge in practical situations.']],
        ] as $index => [$title, $period, $subtitle, $link, $bullets]) {
            ResumeItem::updateOrCreate(
                ['resume_section_id' => $experience->id, 'title' => $title],
                ['period' => $period, 'subtitle' => $subtitle, 'link_url' => $link, 'bullets' => $bullets, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }

        $certs = ResumeSection::updateOrCreate(
            ['portfolio_profile_id' => $profile->id, 'name' => 'Certifications & Training'],
            ['column' => 'right', 'sort_order' => 2, 'is_active' => true]
        );
        ResumeItem::updateOrCreate(
            ['resume_section_id' => $certs->id, 'title' => 'Certificates'],
            ['bullets' => ['Certificate of Appreciation of frontend web development - Issuing Organization: DevTown, Year of Completion: 2022', 'Certificate of Completion front end web development bootcamp - Issuing Organization: DevTown, Year of Completion: 2022', 'Masterclass on Javascript Bootcamp - Issuing Organization: Scaler Academy, Year of Completion: 2022', 'Certificate of Completion Php Language - Issuing Organization: Great Learning, Year of Completion: 2023'], 'sort_order' => 1, 'is_active' => true]
        );

        $categories = [];
        foreach ([['Product', 'product', 1], ['Books', 'books', 2], ['App', 'app', 3]] as [$name, $slug, $order]) {
            $categories[$slug] = PortfolioCategory::updateOrCreate(
                ['slug' => $slug],
                ['name' => $name, 'sort_order' => $order, 'is_active' => true]
            );
        }

        foreach ([
            ['Virtual Data Room', 'A VDR is a secure online repository for storing and sharing confidential documents.', 'img/portfolio/project-vsaedit.png', '/portfolio-details/8', 'product', false],
            ['Portfolio', 'My aim to provide a clear and organized overview of my work and experiences.', 'img/portfolio/project-portfolio (2).png', '/portfolio-details/10', 'product', false],
            ['ExpertAff', 'ExpertAff is a network listing site.', 'img/portfolio/project-expertaff (1).png', '/portfolio-details/7', 'product', false],
            ['Linktester', 'This project is related to URL tracking.', 'img/portfolio/project-linktester (6).png', '/portfolio-details/9', 'app', false],
            ['Shopping Mart', 'Shopping Mart is an online shopping e-commerce site..', 'img/portfolio/project-sopping (1).png', '/portfolio-details/1', 'product', false],
            ['Online Book Store', 'An e-commerce platform tailored for purchasing books online.', 'img/portfolio/project-book (1).jpg', '/portfolio-details/5', 'books', false],
            ['E-commerce site', 'This project showcases my ability to build dynamic E-commerce site.', 'img/portfolio/project-1 (8).png', '/portfolio-details/4', 'product', false],
            ['Login System', 'This project is a robust Login System', 'img/portfolio/project-login (3).jpg', '/portfolio-details/6', 'product', false],
            ['Google Drive Clone', 'This project similar to Google Drive.', 'img/portfolio/project-1 (7).png', '/portfolio-details/3', 'product', false],
            ['Analog Digital Clock', 'The clock is designed to display the current time.', 'img/portfolio/project-1 (6).png', '/portfolio-details/2', 'product', false],
            ['Portfolio Drawer App', null, 'img/app/portfoliodrawer1.jpg', '/android-app/5', 'app', true],
            ['Portfolio Bottom App', null, 'img/app/portfoliotop1.jpg', '/android-app/4', 'app', true],
            ['FriendsList App', null, 'img/app/friendslist (2).png', '/android-app/3', 'app', true],
            ['Login', null, 'img/app/friendslist (1).png', '/android-app/2', 'app', true],
            ['Calculater', null, 'img/app/calcullater (2).png', '/android-app/1', 'app', true],
        ] as $index => [$title, $description, $image, $url, $category, $isMobile]) {
            PortfolioItem::updateOrCreate(
                ['title' => $title],
                ['portfolio_category_id' => $categories[$category]->id, 'description' => $description, 'image' => $image, 'details_url' => $url, 'is_mobile' => $isMobile, 'sort_order' => $index + 1, 'is_active' => true]
            );
        }

        $this->seedPortfolioDetails();

        foreach ([
            ['Address', 'Laxmi Nagar Metro Station New Delhi.', 'bi bi-geo-alt', 1],
            ['Call Us', '+917488952139', 'bi bi-telephone', 2],
            ['Email Us', 'shahidraza7463@gmail.com', 'bi bi-envelope', 3],
        ] as [$label, $value, $icon, $order]) {
            ContactInfo::updateOrCreate(
                ['portfolio_profile_id' => $profile->id, 'label' => $label],
                ['value' => $value, 'icon_class' => $icon, 'sort_order' => $order, 'is_active' => true]
            );
        }

        foreach ([
            ['Happy Clients', 'consequuntur quae', 'bi bi-emoji-smile', 232],
            ['Projects', 'adipisci atque cum quia aut', 'bi bi-journal-richtext', 521],
            ['Hours Of Support', 'aut commodi quaerat', 'bi bi-headset', 1453],
            ['Hard Workers', 'rerum asperiores dolor', 'bi bi-people', 32],
        ] as $index => [$label, $description, $icon, $value]) {
            PortfolioStat::updateOrCreate(
                ['portfolio_profile_id' => $profile->id, 'label' => $label],
                ['description' => $description, 'icon_class' => $icon, 'value' => $value, 'sort_order' => $index + 1, 'is_active' => false]
            );
        }

        foreach ([
            ['Lorem Ipsum', 'shahid deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident', 'bi bi-briefcase'],
            ['Dolor Sitema', 'Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat tarad limino ata', 'bi bi-card-checklist'],
            ['Sed ut perspiciatis', 'Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur', 'bi bi-bar-chart'],
            ['Magni Dolores', 'Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'bi bi-binoculars'],
            ['Nemo Enim', 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque', 'bi bi-brightness-high'],
            ['Eiusmod Tempor', 'Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi', 'bi bi-calendar4-week'],
        ] as $index => [$title, $description, $icon]) {
            Service::updateOrCreate(
                ['portfolio_profile_id' => $profile->id, 'title' => $title],
                ['description' => $description, 'icon_class' => $icon, 'details_url' => '/service-details', 'sort_order' => $index + 1, 'is_active' => false]
            );
        }

        foreach ([
            ['Saul Goodman', 'Ceo & Founder', 'Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit rhoncus.', 'img/testimonials/testimonials-1.jpg'],
            ['Sara Wilsson', 'Designer', 'Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid malis quorum.', 'img/testimonials/testimonials-2.jpg'],
            ['Jena Karlis', 'Store Owner', 'Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem veniam.', 'img/testimonials/testimonials-3.jpg'],
            ['Matt Brandon', 'Freelancer', 'Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim fugiat.', 'img/testimonials/testimonials-4.jpg'],
            ['John Larson', 'Entrepreneur', 'Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster.', 'img/testimonials/testimonials-5.jpg'],
        ] as $index => [$name, $designation, $message, $image]) {
            Testimonial::updateOrCreate(
                ['portfolio_profile_id' => $profile->id, 'name' => $name],
                ['designation' => $designation, 'message' => $message, 'image' => $image, 'sort_order' => $index + 1, 'is_active' => false]
            );
        }
    }

    private function seedPortfolioDetails(): void
    {
        $webSliderStyle = 'box-shadow: 0 8px 16px rgba(0,0,0,0.1); border-radius: 10px;';
        $appSliderStyle = 'box-shadow: 0 8px 16px rgba(0,0,0,0.1); border-radius: 10px; width: 302px;';
        $infoStyle = 'background-color: #fff; padding: 35px; border-radius: 10px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); height: 506px;';
        $appImageStyle = 'height: 460px; width: 302px;';

        $featureList = '<ul style="line-height: 1.9; margin-top: 20px; padding-left: 20px;">
                    <li><strong>Add Network/Program</strong>: Allows users to create new networks.</li>
                    <li><strong>Networks</strong>: View and manage all listed networks in one place.</li>
                    <li><strong>Offers</strong>: Lists all available offers related to the networks.</li>
                    <li><strong>Resources</strong>: Provides resources related to affiliate marketing.</li>
                    <li><strong>Reviews</strong>: Allows users to give reviews on networks and reply to them.</li>
                    <li><strong>Blog</strong>: Users can create and browse blogs related to affiliate marketing.</li>
                </ul>';

        $portfolioAppDescription = '<p>
                    Welcome to my portfolio App! This is a comprehensive showcase of my professional journey,
                    skills, and projects.
                    Through this platform, I aim to provide a clear and organized overview of my work and experiences,
                    all managed
                    seamlessly through an intuitive admin dashboard.
                </p>
                <ul style="line-height: 1.9; margin-top: 20px; padding-left: 20px;">
                    <li><strong>Home</strong>: A quick overview of my professional profile.</li>
                    <li><strong>About</strong>: This section is dedicated to sharing more about me, including my
                        background,
                        skills, and what drives my passion for web development.</li>
                    <li><strong>Resume</strong>: In this section, you can find detailed information about my education,
                        professional experience, technical skills, and certifications.</li>
                    <li><strong>Portfolio</strong>: A collection of projects that I have worked on, showcasing my
                        technical
                        expertise and ability to deliver innovative solutions. Each project is described in detail with
                        its key features.</li>
                    <li><strong>Contact</strong>: This section provides my contact information, including email, phone
                        number,
                        and a contact form for inquiries.</li>
                    <li><strong>Settings</strong>: Options for app personalization.</li>
                </ul>';

        foreach ([
            [
                '/portfolio-details/1',
                [
                    'project_title' => 'Shopping Mart',
                    'category' => 'Web design',
                    'college' => 'ISM',
                    'project_date' => '1 Julu, 2022',
                    'technologies' => 'Php, Mysql, Ajax, Json, JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'project_url' => 'https://github.com/Shahid-Raza7463/E-commerce-website-shopping-mart',
                    'project_url_label' => 'https://shopping.mart.com',
                    'description_title' => 'Shopping Mart',
                    'description' => '<p>My second project, Shopping Mart, is an e-commerce website that I developed during my college
                    years. The platform allows users to browse products, view detailed product information, and
                    in the future, purchase items. While the payment system is not yet implemented, this feature
                    is planned for future updates.</p>
                <p>To build this project, I utilized HTML, CSS, and JavaScript for the frontend, and PHP with
                    MySQL for the backend. The site includes essential features such as user authentication,
                    allowing users to sign up, log in, and log out. Additionally, users can submit their
                    location, which will enable efficient product delivery when the shopping feature is fully
                    functional.</p>',
                ],
                ['img/portfolio/project-sopping (1).jpg', 'img/portfolio/project-sopping (4).png', 'img/portfolio/project-sopping (5).png', 'img/portfolio/project-sopping (6).png', 'img/portfolio/project-sopping (1).png', 'img/portfolio/project-sopping (2).png', 'img/portfolio/project-sopping (3).png', 'img/portfolio/project-sopping (7).png', 'img/portfolio/project-sopping (8).png'],
            ],
            [
                '/portfolio-details/2',
                [
                    'project_title' => 'Analog Digital Clock',
                    'category' => 'Web design',
                    'college' => 'ISM',
                    'project_date' => '01 September, 2022',
                    'technologies' => 'JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'project_url' => 'https://shahid-raza7463.github.io/Analog-Digital-Clock/',
                    'project_url_label' => 'https://analog.digital.clock.com',
                    'description_title' => 'Analog Digital Clock',
                    'description' => '<p>The clock is designed to display the current time in both analog and digital formats. This project was created using JavaScript, HTML, CSS, jQuery, and Bootstrap.</p>',
                ],
                ['img/portfolio/project-1 (6).png', 'img/portfolio/project-1 (61).png'],
            ],
            [
                '/portfolio-details/3',
                [
                    'project_title' => 'Google Drive Clone',
                    'category' => 'Web design',
                    'college' => 'ISM',
                    'project_date' => '01 October, 2022',
                    'technologies' => 'JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'project_url' => 'https://shahid-raza7463.github.io/google_drive_colne/',
                    'project_url_label' => 'https://google.drive.clone.com',
                    'description_title' => 'Google Drive Clone',
                    'description' => '<p>This project is similar to Google Drive and demonstrates a clean interface for managing uploaded files and folders using frontend web technologies.</p>',
                ],
                ['img/portfolio/project-1 (7).png', 'img/portfolio/project-1 (71).png'],
            ],
            [
                '/portfolio-details/4',
                [
                    'project_title' => 'E-commerce site',
                    'category' => 'Web design',
                    'college' => 'ISM',
                    'project_date' => '01 October, 2022',
                    'technologies' => 'JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'description_title' => 'E-commerce site',
                    'description' => '<p>This project showcases my ability to build dynamic E-commerce site layouts with product-focused sections and responsive pages.</p>' . $featureList,
                ],
                ['img/portfolio/project-1 (8).png', 'img/portfolio/project-1 (811).png', 'img/portfolio/project-1 (4).jpg'],
            ],
            [
                '/portfolio-details/5',
                [
                    'project_title' => 'Online Book Store',
                    'category' => 'Web design',
                    'college' => 'ISM',
                    'project_date' => '01 October, 2022',
                    'technologies' => 'JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'description_title' => 'Online Book Store',
                    'description' => '<p>An e-commerce platform tailored for purchasing books online. It includes a simple browsing experience and book-focused product presentation.</p>',
                ],
                ['img/portfolio/project-book (1).jpg', 'img/portfolio/project-book (2).jpg', 'img/portfolio/project-book (5).jpg', 'img/portfolio/project-book (3).jpg', 'img/portfolio/project-book (4).jpg'],
            ],
            [
                '/portfolio-details/6',
                [
                    'project_title' => 'Login System',
                    'category' => 'Web design',
                    'college' => 'ISM',
                    'project_date' => '01 October, 2022',
                    'technologies' => 'JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'description_title' => 'Login System',
                    'description' => '<p>This project is a robust Login System with core authentication screens and user access flow.</p>' . $featureList,
                ],
                ['img/portfolio/project-login (3).jpg', 'img/portfolio/project-login (2).jpg', 'img/portfolio/project-login (1).jpg'],
            ],
            [
                '/portfolio-details/7',
                [
                    'project_title' => 'ExpertAff',
                    'category' => 'Web design',
                    'company' => 'TrakAff-Affiliate Tracking Software',
                    'project_date' => '01 October, 2023',
                    'technologies' => 'Php, Laravel, Mysql, Ajax, Json, JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'project_url' => 'https://shahid-raza7463.github.io/ExpertAff-system/',
                    'project_url_label' => 'www.ExpertAff.com',
                    'description_title' => 'ExpertAff',
                    'description' => '<p>
                    ExpertAff is a platform designed for network listing, where users can create and manage
                    affiliate networks. It allows users to create networks, leave reviews, and respond to them.
                    The system includes features like login, signup, and forgot password functionality. The
                    navbar contains various tabs:
                </p>' . $featureList . '<p>Additionally, the platform offers the ability to:</p>
                <ul style="line-height: 1.9; margin-top: 20px; padding-left: 20px;">
                    <li><strong>Rate Networks</strong>: Users can rate networks to give feedback on their performance and overall experience.</li>
                    <li><strong>Sponsored Ads</strong>: The platform includes space for sponsored advertisements, allowing for promotional content display.</li>
                </ul>
                <p>This project provides a comprehensive platform for managing and interacting with affiliate networks.</p>',
                ],
                ['img/portfolio/project-expertaff (1).png', 'img/portfolio/project-expertaff (2).png', 'img/portfolio/project-expertaff (3).png', 'img/portfolio/project-expertaff (4).png', 'img/portfolio/project-expertaff (5).png', 'img/portfolio/project-expertaff (6).png', 'img/portfolio/project-expertaff (7).png', 'img/portfolio/project-expertaff (8).png'],
            ],
            [
                '/portfolio-details/8',
                [
                    'project_title' => 'Virtual Data Room',
                    'category' => 'Web design',
                    'company' => 'Capitall India Private Limited',
                    'project_date' => '01 October, 2023',
                    'technologies' => 'Php, Laravel, Mysql, Ajax, Json, JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'project_url' => 'https://vsa.capitall.io/',
                    'project_url_label' => 'https://vsa.capitall.io',
                    'description_title' => 'Virtual Data Room',
                    'description' => '<p>
                    A virtual data room (VDR) is a secure online repository for storing and sharing confidential
                    documents. It is used by businesses of all sizes to facilitate mergers and acquisitions (M&A),
                    fundraising, due diligence, and other transactions.
                </p>
                <p>
                    VDRs offer a number of advantages over traditional physical data rooms. They are more secure, as
                    they are hosted in the cloud and protected by strong encryption. They are also more convenient, as
                    users can access them from anywhere with an internet connection. And they are more cost-effective,
                    as there is no need to rent or build a physical space.
                </p>
                <p>
                    <b style="color: #0040f0;">Note: </b>This project includes role-based functionality, such as Admin,
                    Manager, Staff, HR, and others.
                </p>
                <h4>
                    A VDR typically works as follows:
                </h4>
                <ul style="line-height: 1.9; margin-top: 20px; padding-left: 20px;">
                    <li>The organisation that wants to share documents creates a VDR account and invites the users who need access.</li>
                    <li>The users log in to the VDR and upload the documents they want to share.</li>
                    <li>The documents are stored in a secure, password-protected environment.</li>
                    <li>The users can view, download, and print the documents as needed.</li>
                    <li>The organisation can revoke access to the documents at any time.</li>
                </ul>

                <p><b style="color: #0040f0;">Note: </b>Admin can manage all front-end functionalities through the admin dashboard</p>',
                ],
                ['img/portfolio/project-vsaedit.png', 'img/portfolio/project-vsaedit (2).png', 'img/portfolio/project-vsaedit (3).png', 'img/portfolio/project-vsa (4).png', 'img/portfolio/project-vsa (5).png', 'img/portfolio/project-vsa (6).png', 'img/portfolio/project-vsa (7).png', 'img/portfolio/project-vsa (8).png', 'img/portfolio/project-vsa (9).png', 'img/portfolio/project-vsa (10).png', 'img/portfolio/project-vsa (11).png'],
            ],
            [
                '/portfolio-details/9',
                [
                    'project_title' => 'Linktester',
                    'category' => 'Web design',
                    'company' => 'TrakAff-Affiliate Tracking Software',
                    'project_date' => '01 October, 2023',
                    'technologies' => 'Php, Laravel, Mysql, Ajax, Json, JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'description_title' => 'Linktester',
                    'description' => '<p>This project is related to URL tracking and testing, helping users validate tracking links and related affiliate flows.</p>' . $featureList,
                ],
                ['img/portfolio/project-linktester (1).png', 'img/portfolio/project-linktester (2).png', 'img/portfolio/project-linktester (3).png', 'img/portfolio/project-linktester (4).png', 'img/portfolio/project-linktester (5).png', 'img/portfolio/project-linktester (6).png', 'img/portfolio/project-linktester (7).png'],
            ],
            [
                '/portfolio-details/10',
                [
                    'project_title' => 'Portfolio',
                    'category' => 'Web Design',
                    'company' => 'Capitall India Private Limited',
                    'project_date' => '01 October, 2023',
                    'technologies' => 'Php, Laravel, Mysql, Ajax, Json, JavaScript, HTML, CSS, jQuery, Bootstrap,',
                    'project_url' => 'http://shahid1.infinityfreeapp.com',
                    'project_url_label' => 'http://shahid1.infinityfreeapp.com',
                    'description_title' => 'Portfolio',
                    'description' => '<p>
                    Welcome to my portfolio! This is a comprehensive showcase of my professional journey,
                    skills, and projects.
                    Through this platform, I aim to provide a clear and organized overview of my work and experiences,
                    all managed
                    seamlessly through an intuitive admin dashboard.
                </p>
                <ul style="line-height: 1.9; margin-top: 20px; padding-left: 20px;">
                    <li><strong>Home</strong>: The homepage provides a brief introduction to me and my professional journey.</li>
                    <li><strong>About</strong>: This section is dedicated to sharing more about me, including my background, skills, and what drives my passion for web development.</li>
                    <li><strong>Resume</strong>: In this section, you can find detailed information about my education, professional experience, technical skills, and certifications.</li>
                    <li><strong>Portfolio</strong>: A collection of projects that I have worked on, showcasing my technical expertise and ability to deliver innovative solutions. Each project is described in detail with its key features.</li>
                    <li><strong>Contact</strong>: This section provides my contact information, including email, phone number, and a contact form for inquiries. It also includes my location for better accessibility.</li>
                </ul>',
                ],
                ['img/portfolio/project-portfolio (2).png', 'img/portfolio/project-portfolio (4).png', 'img/portfolio/project-portfolio (5).png', 'img/portfolio/project-portfolio (3).png', 'img/portfolio/project-portfolio (1).png'],
            ],
            [
                '/android-app/1',
                [
                    'project_title' => 'Calculator App',
                    'category' => 'Mobile App',
                    'company' => 'Capitall India Private Limited',
                    'project_date' => '01 November, 2024',
                    'technologies' => 'React Native, Apis, Android Studio',
                    'description_title' => 'Calculator App',
                    'description' => '<p>A mobile calculator application built in React Native with a clean Android interface.</p>',
                    'slider_style' => $appSliderStyle,
                    'image_style' => $appImageStyle,
                ],
                ['img/app/calcullater (2).png', 'img/app/calcullater (1).png'],
            ],
            [
                '/android-app/2',
                [
                    'project_title' => 'Portfolio',
                    'category' => 'Mobile App',
                    'company' => 'Capitall India Private Limited',
                    'project_date' => '01 November, 2024',
                    'technologies' => 'React Native, Apis, Android Studio',
                    'description_title' => 'Portfolio',
                    'description' => $portfolioAppDescription,
                    'slider_style' => $appSliderStyle,
                    'image_style' => $appImageStyle,
                ],
                ['img/app/portfolioapp2.png', 'img/app/portfolioapp5.png', 'img/app/portfolioapp3.png', 'img/app/portfolioapp4.png', 'img/app/portfolioapp6.png', 'img/app/portfolioapp1.png'],
            ],
            [
                '/android-app/3',
                [
                    'project_title' => 'FriendsList App',
                    'category' => 'Mobile App',
                    'company' => 'Capitall India Private Limited',
                    'project_date' => '01 November, 2024',
                    'technologies' => 'React Native, Apis, Android Studio',
                    'description_title' => 'FriendsList App',
                    'description' => '<p>FriendsList App is a React Native mobile app created to explore app development fundamentals with list-based screens and Android Studio tooling.</p>',
                    'slider_style' => $appSliderStyle,
                    'image_style' => $appImageStyle,
                ],
                ['img/app/friendslist (4).png', 'img/app/friendslist (3).png', 'img/app/friendslist (2).png', 'img/app/friendslist (5).png'],
            ],
            [
                '/android-app/4',
                [
                    'project_title' => 'Portfolio Bottom App',
                    'category' => 'Mobile App',
                    'company' => 'Capitall India Private Limited',
                    'project_date' => '01 November, 2024',
                    'technologies' => 'React Native, Apis, Android Studio',
                    'description_title' => 'Portfolio Bottom App',
                    'description' => $portfolioAppDescription,
                    'slider_style' => $appSliderStyle,
                    'image_style' => $appImageStyle,
                ],
                ['img/app/portfoliotop1.jpg', 'img/app/portfoliotop2.jpg', 'img/app/portfoliotop3.jpg', 'img/app/portfoliotop4.jpg', 'img/app/portfoliotop5.jpg', 'img/app/portfoliotop6.jpg'],
            ],
            [
                '/android-app/5',
                [
                    'project_title' => 'Portfolio Drawer App',
                    'category' => 'Mobile App',
                    'company' => 'Capitall India Private Limited',
                    'project_date' => '01 November, 2024',
                    'technologies' => 'React Native, Apis, Android Studio',
                    'description_title' => 'Portfolio Drawer App',
                    'description' => $portfolioAppDescription,
                    'slider_style' => $appSliderStyle,
                    'image_style' => $appImageStyle,
                ],
                ['img/app/portfoliodrawer1.jpg', 'img/app/portfoliodrawer2.jpg', 'img/app/portfoliodrawer3.jpg', 'img/app/portfoliodrawer4.jpg', 'img/app/portfoliodrawer5.jpg', 'img/app/portfoliodrawer6.jpg', 'img/app/portfoliodrawer7.jpg'],
            ],
        ] as [$url, $data, $images]) {
            $this->portfolioDetail($url, array_merge([
                'page_title' => 'Portfolio Details',
                'breadcrumb_title' => 'Portfolio Details',
                'slider_style' => $webSliderStyle,
                'image_style' => null,
                'info_style' => $infoStyle,
            ], $data), $images);
        }
    }

    private function portfolioDetail(string $detailsUrl, array $data, array $images): void
    {
        $portfolioItem = PortfolioItem::where('details_url', $detailsUrl)->first();

        if (! $portfolioItem) {
            return;
        }

        $detail = PortfolioDetail::updateOrCreate(
            ['portfolio_item_id' => $portfolioItem->id],
            $data
        );

        PortfolioDetailImage::where('portfolio_detail_id', $detail->id)
            ->whereNotIn('image', $images)
            ->delete();

        foreach ($images as $index => $image) {
            [$width, $height] = $this->imageDimensions($image, $data['image_style'] ? 302 : null, $data['image_style'] ? 460 : null);

            PortfolioDetailImage::updateOrCreate(
                ['portfolio_detail_id' => $detail->id, 'image' => $image],
                ['width' => $width, 'height' => $height, 'sort_order' => $index + 1]
            );
        }
    }

    private function imageDimensions(string $image, ?int $fallbackWidth = null, ?int $fallbackHeight = null): array
    {
        $path = public_path($image);

        if (is_file($path)) {
            $size = @getimagesize($path);

            if ($size) {
                return [$fallbackWidth ?: $size[0], $fallbackHeight ?: $size[1]];
            }
        }

        return [$fallbackWidth, $fallbackHeight];
    }
}
