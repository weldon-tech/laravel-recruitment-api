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
            'personal.photo' => 'required|string',
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

            'work_experience.previous_organization' => 'required|string|max:255',
            'work_experience.position' => 'required|string|max:255',
            'work_experience.period_employment' => 'required|array|min:1',
            'work_experience.period_employment.*' => 'required|date', // Ensures the dates are in the correct format
            'work_experience.reason_for_dismissal' => 'required|string|max:255',

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
}
