<?php

namespace Weldon\LaravelRecruitmentApi\Http\Controllers;

use Mews\Captcha\Captcha;

class SigInController
{
    public function generateCaptcha()
    {
        return \Mews\Captcha\Facades\Captcha::create(config('recruitment.captcha.default'), true);
    }
}
