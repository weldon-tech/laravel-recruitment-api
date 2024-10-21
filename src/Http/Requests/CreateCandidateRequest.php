<?php

namespace Juraboyev\LaravelRecruitmentApi\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateCandidateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'key'=>['required','string'],
            'captcha' => ['required', 'captcha_api:'.$this->get('key').',math'],

            'personal.photo' => 'required',
            'personal.first_name' => 'required|string|max:255',
            'personal.last_name' => 'required|string|max:255',
            'personal.middle_name' => 'required|string|max:255',
            'personal.born_day' => 'required|date',

            'additional.citizenship' => 'required|string|max:255',
            'additional.nation' => 'required|string|max:255',
            'additional.province' => 'required|integer',
            'additional.district' => 'required|integer',
            'additional.mca' => 'required|integer',
            'additional.address' => 'required|string|max:255',
            'additional.phone_number' => 'required|string|regex:/^\+998\d{9}$/',
            'additional.additional_number' => 'required|string|regex:/^\+998\d{9}$/',

            'family_situation.family_situation' => 'required|in:MARRIED,NOT_MARRIED',
            'family_situation.has_children' => 'required|boolean',
            'family_situation.children' => 'required_if:family_situation.has_children,true|integer|min:1',

            'study_period.educational_institution' => 'required|string|max:255',
            'study_period.direction' => 'required|string|max:255',
            'study_period.admission_year' => 'required|integer|min:1900|max:'.date('Y'),
            'study_period.graduation_year' => 'required|integer|min:1900|max:'.date('Y'),
            'study_period.field' => 'required|string|max:255',

            'additional_skills_languages' => 'required|array',
            'additional_skills_languages.*.language' => 'required|string|max:255',
            'additional_skills_languages.*.level' => 'required|in:SATISFACTORY,GOOD,BEST',

            'additional_skills_others' => 'required|array',
            'additional_skills_others.*.skill_name' => 'required|string|max:255',
            'additional_skills_others.*.level' => 'required|in:SATISFACTORY,GOOD,BEST',

            'work_experience.previous_organization' => 'nullable|string|max:255',
            'work_experience.position' => 'nullable|string|max:255',
            'work_experience.period_employment' => 'nullable|array|min:2|max:2',
            'work_experience.period_employment.*' => 'nullable|date_format:Y-m-d',
            'work_experience.reason_for_dismissal' => 'nullable|string|max:255',

            'additional_questions.has_bad_habits' => 'required|boolean',
            'additional_questions.how_bad_habits' => 'required|string|max:255',

            'select_positions' => 'required|array',
            'select_positions.*' => 'required|string|max:255',

            'other_questions.salary' => 'required|integer',
            'other_questions.about_your_self' => 'required|string|max:1000',
            'other_questions.chronic_diseases' => 'required|boolean',
            'other_questions.pregnant' => 'required|boolean',

            'about_family' => 'required|array',
            'about_family.*.kinship' => 'required|string|max:255',
            'about_family.*.full_name' => 'required|string|max:255',
            'about_family.*.work_place' => 'required|string|max:255',
            'about_family.*.address' => 'required|string|max:255',

            'advertising_sources' => 'required|array',
            'advertising_sources.*' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'personal.photo.required' => 'Rasm kiritilishi shart.',
            'personal.photo.string' => 'Rasm matn bo\'lishi kerak.',
            'personal.first_name.required' => 'Ism kiritilishi shart.',
            'personal.first_name.string' => 'Ism matn bo\'lishi kerak.',
            'personal.first_name.max' => 'Ism 255 belgidan oshmasligi kerak.',
            'personal.last_name.required' => 'Familiya kiritilishi shart.',
            'personal.last_name.string' => 'Familiya matn bo\'lishi kerak.',
            'personal.last_name.max' => 'Familiya 255 belgidan oshmasligi kerak.',
            'personal.middle_name.required' => 'Otasi ismi kiritilishi shart.',
            'personal.middle_name.string' => 'Otasi ismi matn bo\'lishi kerak.',
            'personal.middle_name.max' => 'Otasi ismi 255 belgidan oshmasligi kerak.',
            'personal.born_day.required' => 'Tug\'ilgan sana kiritilishi shart.',
            'personal.born_day.date' => 'Tug\'ilgan sana to\'g\'ri sana emas.',

            'additional.citizenship.required' => 'Fuqarolik kiritilishi shart.',
            'additional.citizenship.string' => 'Fuqarolik matn bo\'lishi kerak.',
            'additional.citizenship.max' => 'Fuqarolik 255 belgidan oshmasligi kerak.',
            'additional.nation.required' => 'Millat kiritilishi shart.',
            'additional.nation.string' => 'Millat matn bo\'lishi kerak.',
            'additional.nation.max' => 'Millat 255 belgidan oshmasligi kerak.',
            'additional.province.required' => 'Viloyat kiritilishi shart.',
            'additional.province.integer' => 'Viloyat raqami butun son bo\'lishi kerak.',
            'additional.district.required' => 'Tuman kiritilishi shart.',
            'additional.district.integer' => 'Tuman raqami butun son bo\'lishi kerak.',
            'additional.mca.required' => 'MCA kiritilishi shart.',
            'additional.mca.integer' => 'MCA raqami butun son bo\'lishi kerak.',
            'additional.address.required' => 'Manzil kiritilishi shart.',
            'additional.address.string' => 'Manzil matn bo\'lishi kerak.',
            'additional.address.max' => 'Manzil 255 belgidan oshmasligi kerak.',
            'additional.phone_number.required' => 'Telefon raqami kiritilishi shart.',
            'additional.phone_number.string' => 'Telefon raqami matn bo\'lishi kerak.',
            'additional.phone_number.regex' => 'Telefon raqami to\'g\'ri formatda emas (masalan, +998xxxxxxxxx).',
            'additional.additional_number.required' => 'Qo\'shimcha raqam kiritilishi shart.',
            'additional.additional_number.string' => 'Qo\'shimcha raqam matn bo\'lishi kerak.',
            'additional.additional_number.regex' => 'Qo\'shimcha raqam to\'g\'ri formatda emas (masalan, +998xxxxxxxxx).',

            'family_situation.family_situation.required' => 'Oilaviy holat kiritilishi shart.',
            'family_situation.family_situation.in' => 'Oilaviy holat to\'g\'ri emas.',
            'family_situation.has_children.required' => 'Bolalar borligi haqida ma\'lumot kiritilishi shart.',
            'family_situation.has_children.boolean' => 'Bolalar borligi to\'g\'ri yoki noto\'g\'ri bo\'lishi kerak.',
            'family_situation.children.required_if' => 'Agar bolalar bo\'lsa, ularni soni kiritilishi shart.',
            'family_situation.children.integer' => 'Bolalar soni butun son bo\'lishi kerak.',
            'family_situation.children.min' => 'Bolalar soni kamida 1 bo\'lishi kerak.',

            'study_period.educational_institution.required' => 'Ta\'lim muassasasi kiritilishi shart.',
            'study_period.educational_institution.string' => 'Ta\'lim muassasasi matn bo\'lishi kerak.',
            'study_period.educational_institution.max' => 'Ta\'lim muassasasi 255 belgidan oshmasligi kerak.',
            'study_period.direction.required' => 'Yo\'nalish kiritilishi shart.',
            'study_period.direction.string' => 'Yo\'nalish matn bo\'lishi kerak.',
            'study_period.direction.max' => 'Yo\'nalish 255 belgidan oshmasligi kerak.',
            'study_period.admission_year.required' => 'Qabul yili kiritilishi shart.',
            'study_period.admission_year.integer' => 'Qabul yili butun son bo\'lishi kerak.',
            'study_period.admission_year.min' => 'Qabul yili 1900 yildan kam bo\'lmasligi kerak.',
            'study_period.admission_year.max' => 'Qabul yili hozirgi yildan oshmasligi kerak.',
            'study_period.graduation_year.required' => 'Bitiruv yili kiritilishi shart.',
            'study_period.graduation_year.integer' => 'Bitiruv yili butun son bo\'lishi kerak.',
            'study_period.graduation_year.min' => 'Bitiruv yili 1900 yildan kam bo\'lmasligi kerak.',
            'study_period.graduation_year.max' => 'Bitiruv yili hozirgi yildan oshmasligi kerak.',
            'study_period.field.required' => 'Soha kiritilishi shart.',
            'study_period.field.string' => 'Soha matn bo\'lishi kerak.',
            'study_period.field.max' => 'Soha 255 belgidan oshmasligi kerak.',

            'additional_skills_languages.required' => 'Qo\'shimcha tillar kiritilishi shart.',
            'additional_skills_languages.array' => 'Qo\'shimcha tillar massiv bo\'lishi kerak.',
            'additional_skills_languages.*.language.required' => 'Til kiritilishi shart.',
            'additional_skills_languages.*.language.string' => 'Til matn bo\'lishi kerak.',
            'additional_skills_languages.*.language.max' => 'Til 255 belgidan oshmasligi kerak.',
            'additional_skills_languages.*.level.required' => 'Til darajasi kiritilishi shart.',
            'additional_skills_languages.*.level.in' => 'Til darajasi to\'g\'ri emas (SATISFACTORY, GOOD, BEST).',

            'additional_skills_others.required' => 'Boshqa ko\'nikmalar kiritilishi shart.',
            'additional_skills_others.array' => 'Boshqa ko\'nikmalar massiv bo\'lishi kerak.',
            'additional_skills_others.*.skill_name.required' => 'Ko\'nikma nomi kiritilishi shart.',
            'additional_skills_others.*.skill_name.string' => 'Ko\'nikma nomi matn bo\'lishi kerak.',
            'additional_skills_others.*.skill_name.max' => 'Ko\'nikma nomi 255 belgidan oshmasligi kerak.',
            'additional_skills_others.*.level.required' => 'Ko\'nikma darajasi kiritilishi shart.',
            'additional_skills_others.*.level.in' => 'Ko\'nikma darajasi to\'g\'ri emas (SATISFACTORY, GOOD, BEST).',

            'work_experience.previous_organization.required' => 'Avvalgi tashkilot kiritilishi shart.',
            'work_experience.previous_organization.string' => 'Avvalgi tashkilot matn bo\'lishi kerak.',
            'work_experience.previous_organization.max' => 'Avvalgi tashkilot 255 belgidan oshmasligi kerak.',
            'work_experience.position.required' => 'Lavozim kiritilishi shart.',
            'work_experience.position.string' => 'Lavozim matn bo\'lishi kerak.',
            'work_experience.position.max' => 'Lavozim 255 belgidan oshmasligi kerak.',
            'work_experience.period_employment.required' => 'Ishga qabul davri kiritilishi shart.',
            'work_experience.period_employment.array' => 'Ishga qabul davri massiv bo\'lishi kerak.',
            'work_experience.period_employment.min' => 'Ishga qabul davri kamida 1 ta bo\'lishi kerak.',
            'work_experience.period_employment.*.required' => 'Ishga qabul davri kiritilishi shart.',
            'work_experience.period_employment.*.date' => 'Ishga qabul davri to\'g\'ri sana emas.',
            'work_experience.reason_for_dismissal.required' => 'Ishdan bo\'shatilish sababi kiritilishi shart.',
            'work_experience.reason_for_dismissal.string' => 'Ishdan bo\'shatilish sababi matn bo\'lishi kerak.',
            'work_experience.reason_for_dismissal.max' => 'Ishdan bo\'shatilish sababi 255 belgidan oshmasligi kerak.',

            'additional_questions.has_bad_habits.required' => 'Yomon odatlar mavjudligi kiritilishi shart.',
            'additional_questions.has_bad_habits.boolean' => 'Yomon odatlar mavjudligi to\'g\'ri yoki noto\'g\'ri bo\'lishi kerak.',
            'additional_questions.how_bad_habits.required' => 'Yomon odatlar qandayligi haqida ma\'lumot kiritilishi shart.',
            'additional_questions.how_bad_habits.string' => 'Yomon odatlar qandayligi matn bo\'lishi kerak.',
            'additional_questions.how_bad_habits.max' => 'Yomon odatlar qandayligi 255 belgidan oshmasligi kerak.',

            'select_positions.required' => 'Tanlangan lavozimlar kiritilishi shart.',
            'select_positions.array' => 'Tanlangan lavozimlar massiv bo\'lishi kerak.',
            'select_positions.*.required' => 'Tanlangan lavozim kiritilishi shart.',
            'select_positions.*.string' => 'Tanlangan lavozim matn bo\'lishi kerak.',
            'select_positions.*.max' => 'Tanlangan lavozim 255 belgidan oshmasligi kerak.',

            'other_questions.salary.required' => 'Maosh kiritilishi shart.',
            'other_questions.salary.integer' => 'Maosh raqami butun son bo\'lishi kerak.',
            'other_questions.about_your_self.required' => 'O\'zingiz haqingizda ma\'lumot kiritilishi shart.',
            'other_questions.about_your_self.string' => 'O\'zingiz haqingizda ma\'lumot matn bo\'lishi kerak.',
            'other_questions.about_your_self.max' => 'O\'zingiz haqingizda ma\'lumot 1000 belgidan oshmasligi kerak.',
            'other_questions.chronic_diseases.required' => 'Xronik kasalliklar mavjudligi kiritilishi shart.',
            'other_questions.chronic_diseases.boolean' => 'Xronik kasalliklar mavjudligi to\'g\'ri yoki noto\'g\'ri bo\'lishi kerak.',
            'other_questions.pregnant.required' => 'Homiladorlik holati kiritilishi shart.',
            'other_questions.pregnant.boolean' => 'Homiladorlik holati to\'g\'ri yoki noto\'g\'ri bo\'lishi kerak.',

            'about_family.required' => 'Oila haqida ma\'lumot kiritilishi shart.',
            'about_family.array' => 'Oila haqida ma\'lumot massiv bo\'lishi kerak.',
            'about_family.*.kinship.required' => 'Qarindoshlik kiritilishi shart.',
            'about_family.*.kinship.string' => 'Qarindoshlik matn bo\'lishi kerak.',
            'about_family.*.kinship.max' => 'Qarindoshlik 255 belgidan oshmasligi kerak.',
            'about_family.*.full_name.required' => 'To\'liq ism kiritilishi shart.',
            'about_family.*.full_name.string' => 'To\'liq ism matn bo\'lishi kerak.',
            'about_family.*.full_name.max' => 'To\'liq ism 255 belgidan oshmasligi kerak.',
            'about_family.*.work_place.required' => 'Ish joyi kiritilishi shart.',
            'about_family.*.work_place.string' => 'Ish joyi matn bo\'lishi kerak.',
            'about_family.*.work_place.max' => 'Ish joyi 255 belgidan oshmasligi kerak.',
            'about_family.*.address.required' => 'Manzil kiritilishi shart.',
            'about_family.*.address.string' => 'Manzil matn bo\'lishi kerak.',
            'about_family.*.address.max' => 'Manzil 255 belgidan oshmasligi kerak.',

            'advertising_sources.required' => 'Reklama manbalari kiritilishi shart.',
            'advertising_sources.array' => 'Reklama manbalari massiv bo\'lishi kerak.',
            'advertising_sources.*.required' => 'Reklama manbasi kiritilishi shart.',
            'advertising_sources.*.string' => 'Reklama manbasi matn bo\'lishi kerak.',
            'advertising_sources.*.max' => 'Reklama manbasi 255 belgidan oshmasligi kerak.',
        ];
    }
}
