<?php

namespace App\Enums;

enum Section: string
{
    // ===== Intro Page Sections =====
    case IntroVideo = 'intro_video';
    case IntroSection = 'intro_section';
    // ===== Home Page Sections =====
    case HeroSection = 'hero_section';
    case ServicesSection = 'services_section';
    case ServicesSectionContent = 'services_section_content';
    case Footer = 'footer';


    // ===== Contact Us Page Sections =====
    case Main = 'main';
    case Form = 'form';


}


