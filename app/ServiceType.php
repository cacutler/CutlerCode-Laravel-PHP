<?php
namespace App;
enum ServiceType: string {
    case WEBSITE = "website";
    case WEB_APP = "web app";
    case MOBILE_APP = "mobile app";
    case CONSULTING = "consulting";
    case TOOL = "tool";
    case IT = "IT";
    case OTHER = "other";
}