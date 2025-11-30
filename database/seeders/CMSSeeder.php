<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('c_m_s')->insert([
            ['id' => '1', 'page' => 'intro_page', 'section' => 'intro_video', 'title' => NULL, 'sub_title' => NULL, 'image' => 'uploads/intro-video/1764066143-1764066143-leja-re-dhvani-bhanushali-tanishk-bagchi-rashmi-virag-radhika-rao-vinay-sapru-siddharth.mp4', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-25 10:20:33', 'updated_at' => '2025-11-25 10:22:23'],
            [
                'id' => '2',
                'page' => 'intro_page',
                'section' => 'intro_section',
                'title' => 'EL GABACHO ENGINEERS & CO',
                'sub_title' => 'Contact',
                'image' => 'uploads/intro-section/1764067192-1764067192-rectangle-2.png',
                'background_image' => NULL,
                'description' => 'Engineering the Future with Integrity. Reliable.
Efficient. Professional.',
                'sub_description' => NULL,
                'button_text' => 'Get Started',
                'link_url' => NULL,
                'tags' => NULL,
                'status' => 'active',
                'created_at' => '2025-11-25 10:39:52',
                'updated_at' => '2025-11-25 10:41:23'
            ],
            ['id' => '3', 'page' => 'home_page', 'section' => 'hero_section', 'title' => NULL, 'sub_title' => NULL, 'image' => 'uploads/hero_section/1764214820-1764214820-rectangle-1.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-25 11:05:33', 'updated_at' => '2025-11-27 03:40:20'],
            ['id' => '4', 'page' => 'home_page', 'section' => 'services_section', 'title' => 'Our Services', 'sub_title' => NULL, 'image' => NULL, 'background_image' => NULL, 'description' => '<p>At El Gabacho Records our engineers not onlyhand craft and tailor Master Tracks, we are dedicated to innovating the many aspects that come with the love for music.With focus on Research &amp; Design on new emerging technologies for the Industry, one piece at a time, rest assured our Gabachos\' are hard at work.</p><p><br></p><p>🔄<strong> Professional Designers</strong></p><p><strong>🔄 Premium-Quality Materials</strong></p><p><strong>🔄 Fast Delivery &amp; Installation</strong></p><p><strong>🔄 100% Customer Satisfaction</strong></p>', 'sub_description' => NULL, 'button_text' => 'Learn More', 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-26 06:19:41', 'updated_at' => '2025-11-26 06:29:16'],
            ['id' => '5', 'page' => 'home_page', 'section' => 'services_section_content', 'title' => NULL, 'sub_title' => NULL, 'image' => 'uploads/how_it_work/1764138887-1764138887-rectangle-3.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-26 06:34:47', 'updated_at' => '2025-11-26 06:34:47'],
            ['id' => '6', 'page' => 'home_page', 'section' => 'services_section_content', 'title' => NULL, 'sub_title' => NULL, 'image' => 'uploads/how_it_work/1764138895-1764138895-rectangle-4.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-26 06:34:55', 'updated_at' => '2025-11-26 06:34:55'],
            ['id' => '7', 'page' => 'home_page', 'section' => 'services_section_content', 'title' => NULL, 'sub_title' => NULL, 'image' => 'uploads/how_it_work/1764138900-1764138900-rectangle-2.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-26 06:35:00', 'updated_at' => '2025-11-26 06:35:00'],
            ['id' => '8', 'page' => 'service_page', 'section' => 'hero_section', 'title' => 'Our Merchandise', 'sub_title' => NULL, 'image' => 'uploads/hero_section/1764214852-1764214852-rectangle-2-1.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 03:39:46', 'updated_at' => '2025-11-27 03:40:52'],
            ['id' => '9', 'page' => 'service_page', 'section' => 'service_section', 'title' => 'What\'s are Available', 'sub_title' => NULL, 'image' => NULL, 'background_image' => NULL, 'description' => 'Modern, Elegant & Custom Wall Creations for Every Room Your Wall. Your Style. Our Expertise', 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 03:43:01', 'updated_at' => '2025-11-27 03:43:01'],
            ['id' => '10', 'page' => 'contact_us_page', 'section' => 'hero_section', 'title' => 'Contact', 'sub_title' => NULL, 'image' => 'uploads/hero_section/1764217445-1764217445-rectangle-2-1.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 04:24:05', 'updated_at' => '2025-11-27 04:24:05'],
            ['id' => '11', 'page' => 'contact_us_page', 'section' => 'contact_section', 'title' => 'Contact Us', 'sub_title' => NULL, 'image' => NULL, 'background_image' => NULL, 'description' => 'Let’s grow together through affiliate and merch collaborations. Partner with us to promote and sell our products.', 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => NULL, 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 04:24:27', 'updated_at' => '2025-11-27 04:24:27'],
            
            ['id' => '12', 'page' => 'home_page', 'section' => 'social_link_container', 'title' => 'facebook', 'sub_title' => NULL, 'image' => 'uploads/social_link/facebook.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => 'https://www.facebook.com/husoaib12', 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 04:27:19', 'updated_at' => '2025-11-27 04:27:19'],
            ['id' => '13', 'page' => 'home_page', 'section' => 'social_link_container', 'title' => 'twitter', 'sub_title' => NULL, 'image' => 'uploads/social_link/twitter.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => 'https://www.twitter.com/husoaib12', 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 04:27:19', 'updated_at' => '2025-11-27 04:27:19'],
            ['id' => '14', 'page' => 'home_page', 'section' => 'social_link_container', 'title' => 'instagram', 'sub_title' => NULL, 'image' => 'uploads/social_link/instagram.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => 'https://www.instagram.com/husoaib12', 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 04:27:19', 'updated_at' => '2025-11-27 04:27:19'],
            ['id' => '15', 'page' => 'home_page', 'section' => 'social_link_container', 'title' => 'youtube', 'sub_title' => NULL, 'image' => 'uploads/social_link/youtube.png', 'background_image' => NULL, 'description' => NULL, 'sub_description' => NULL, 'button_text' => NULL, 'link_url' => 'https://www.youtube.com/husoaib12', 'tags' => NULL, 'status' => 'active', 'created_at' => '2025-11-27 04:27:19', 'updated_at' => '2025-11-27 04:27:19']

        ]);
    }
}


