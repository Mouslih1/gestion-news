<?php

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if(!function_exists('blog_info'))
{
    function blog_info()
    {
        return Setting::find(2);
    }
}



/**
 * DATE FORMAT eg: Janvier 12, 2024
 */
if(!function_exists('date_formatter'))
{
    function date_formatter($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('LL');
    }
}

/**
 * STRIP WORDS
 */
if(!function_exists('words'))
{
    function words($value, $words = 15 ,$end = '...' )
    {
        return Str::words(strip_tags($value), $words, $end);
    }
}

/**
 * check if user have internet connection
 */
if(!function_exists('isOnline'))
{
    function isOnline($site = 'https://youtube.com/')
    {
        if(@fopen($site, 'r'))
        {
            return true;
        }else{
            return false;
        }
    }
}

/**
 * Reading article duration
 */
if(!function_exists('readDuration'))
{
    function readDuration(...$text)
    {
        Str::macro('timeCounter', function($text){
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords/200);
            return (int)max( 1 , $minutesToRead);
        });
        return Str::timeCounter($text);
    }
}

/**
 * DISPLAY HOME MAIN LATEST POST
 */
if(!function_exists('single_latest_post'))
{
    function single_latest_post()
    {
        return Post::with('author')
                     ->with('subcategory')
                     ->limit(1)
                     ->orderBy('created_at', 'desc')
                     ->first();
    }
}

/**
 * Dispaly home 6 latest post
 */

if(!function_exists('latest_home_6posts'))
{
    function latest_home_6posts()
    {
        return Post::with('author')
                    ->with('subcategory')
                    ->skip(1)
                    ->limit(6)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}

/**
 * Display home random posts
 */

if(!function_exists('recommended_posts'))
{
    function recommended_posts()
    {
        return Post::with('author')
                    ->with('subcategory')
                    ->limit(4)
                    ->inRandomOrder()
                    ->get();
    }
}

/**
 * Diplay home random post recommanded
 */

if(!function_exists('single_recommended_posts'))
{
     function single_recommended_posts()
     {
         return Post::with('author')
                     ->with('subcategory')
                     ->limit(4)
                     ->inRandomOrder()
                     ->first();
     }
}

/**
 * Category with number posts
 */

if(!function_exists('categories'))
{
    function categories()
    {
        return Subcategory::whereHas('posts')
                            ->with('posts')
                            ->orderBy('subcategory_name', 'asc')
                            ->get();
    }
}

/**
 * sidebar lastest posts
 */

if(!function_exists('latest_sidebar_post'))
{
    function latest_sidebar_post($except = null, $limit = 4)
    {
        return Post::where('id', '!=', $except)
                    ->limit($limit)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }
}


if(!function_exists('latest_first_sidebar_post'))
{
    function latest_first_sidebar_post($except = null)
    {
        return Post::where('id', '!=', $except)
                    ->orderBy('created_at', 'desc')
                    ->first();
    }
}


/**
 * function help to send email
 */
/*
if(!function_exists('send_email'))
{
    function send_email($mailConfig)
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('EMAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('EMAIL_USERNAME');
        $mail->Password = env('EMAIL_PASSWORD');
        $mail->SMTPSecure = env('EMAIL_ENCRYPTION');
        $mail->Port = env('EMAIL_PORT');
        $mail->setFrom($mailConfig['mail_from_email'], $mailConfig['mail_from_name']);
        $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];


        if($mail->send())
        {
            return true;
        }else{
            return false;
        }
    }
}*/

/**
 * all tags
 */

if(!function_exists('all_tags'))
{
    function all_tags()
    {
        return Post::where('post_tags','!=', null)->distinct()->pluck('post_tags')->join(',');
    }
}
?>
