<?php

namespace Weldon\LaravelRecruitmentApi\Candidate\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Weldon\LaravelRecruitmentApi\Models\CandidateAddress;
use Weldon\LaravelRecruitmentApi\Models\CandidateAdvertisingSource;
use Weldon\LaravelRecruitmentApi\Models\CandidateDetail;
use Weldon\LaravelRecruitmentApi\Models\CandidateEducationDetail;
use Weldon\LaravelRecruitmentApi\Models\CandidateExperience;
use Weldon\LaravelRecruitmentApi\Models\CandidateFamilyMember;
use Weldon\LaravelRecruitmentApi\Models\CandidateLangSkill;
use Weldon\LaravelRecruitmentApi\Models\CandidateOtherSkill;
use Weldon\LaravelRecruitmentApi\Models\CandidateSelectedPosition;

class Candidate
{
    public int $id;

    public Personal $personal;

    public Additional $additional;

    public FamilySituation $familySituation;

    public StudyPeriod $studyPeriod;

    /** @var AdditionalSkillsLanguages[] */
    public array $additionalSkillsLanguages;

    /** @var AdditionalSkillsOthers[] */
    public array $additionalSkillsOthers;

    public WorkExperience $workExperience;

    public AdditionalQuestions $additionalQuestions;

    /** @var string[] */
    public array $selectPositions;

    public OtherQuestions $otherQuestions;

    /** @var AboutFamily[] */
    public array $aboutFamily;

    /** @var string[] */
    public array $advertisingSources;

    public array $data;

    public string|null $chatId;

    public function __construct(array $data)
    {
        $this->personal = new Personal($data['personal']);
        $this->additional = new Additional($data['additional']);
        $this->familySituation = new FamilySituation($data['family_situation']);
        $this->studyPeriod = new StudyPeriod($data['study_period']);
        $this->workExperience = new WorkExperience($data['work_experience']);
        $this->additionalQuestions = new AdditionalQuestions($data['additional_questions']);
        $this->otherQuestions = new OtherQuestions($data['other_questions']);

        $this->aboutFamily = array_map(function ($aboutFamily) {
            return new AboutFamily($aboutFamily);
        }, $data['about_family']);

        $this->additionalSkillsLanguages = array_map(function ($additionalSkillsLanguage) {
            return new AdditionalSkillsLanguages($additionalSkillsLanguage);
        }, $data['additional_skills_languages']);

        $this->additionalSkillsOthers = array_map(function ($additionalSkillOthers) {
            return new AdditionalSkillsOthers($additionalSkillOthers);
        }, $data['additional_skills_others']);

        $this->selectPositions = $data['select_positions'];
        $this->advertisingSources = $data['advertising_sources'];
        $this->chatId = $data['chat_id'] ?? null;
    }

    public function store()
    {
        DB::beginTransaction();
        try {
            $this->storeCandidate();

            $this->storeCandidateAddress();

            $this->storeCandidateAdvertisingSources();

            $this->storeCandidateDetails();

            $this->storeCandidateEducationDetail();

            $this->storeCandidateExperience();

            $this->storeCandidateFamilyMembers();

            $this->storeCandidateLangSkills();

            $this->storeCandidateOtherSkills();

            $this->storeCandidateSelectedPosition();

            DB::commit();

            return Response::json(['message' => 'Ma\'lumot saqlandi']);

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function storeCandidate()
    {
        // Remove the Base64 header from the string
        $base64Image = substr($this->personal->photo, strpos($this->personal->photo, ',') + 1);

        $organizationName = config('app.storage_path');

        // Decode the Base64 string
        $image = base64_decode($base64Image);

        $extension = explode('/', explode(':', substr($this->personal->photo, 0, strpos($this->personal->photo, ';')))[1])[1];

        $fileName = $organizationName.'/'.uniqid() . '.' . $extension;

        Storage::disk(config('recruitment.storage.disk'))->put($fileName,$image);

        $candidate = \Weldon\LaravelRecruitmentApi\Models\Candidate::query()
            ->create([
                'first_name' => $this->personal->firstName,
                'last_name' => $this->personal->lastName,
                'middle_name' => $this->personal->middleName,
                'full_name' => $this->personal->lastName.' '.$this->personal->firstName.' '.$this->personal->middleName,
                'born_date' => date('Y-m-d', strtotime($this->personal->bornDay)),
                'photo_url' => $fileName,
                'citizenship' => $this->additional->citizenship,
                'nation' => $this->additional->nation,
                'phone_number' => $this->additional->phoneNumber,
                'additional_phone_number' => $this->additional->additionalNumber,
                'about' => $this->otherQuestions->aboutYourSelf,
                'education_level'=>$this->studyPeriod->educationLevel,
            ]);

        $this->id = $candidate->id;
    }

    public function storeCandidateAddress(): void
    {
        CandidateAddress::query()->create([
            'candidate_id' => $this->id,
            'province_id' => $this->additional->province,
            'region_id' => $this->additional->district,
            'village_id' => $this->additional->mca,
            'street' => $this->additional->address,
        ]);
    }

    public function storeCandidateAdvertisingSources(): void
    {
        foreach ($this->advertisingSources as $advertisingSource) {
            CandidateAdvertisingSource::query()->create([
                'candidate_id' => $this->id,
                'name' => $advertisingSource,
            ]);
        }
    }

    public function storeCandidateDetails(): void
    {
        CandidateDetail::query()->create([
            'candidate_id' => $this->id,
            'has_bad_habits' => $this->additionalQuestions->hasBadHabits,
            'how_bad_habits' => $this->additionalQuestions->howBadHabits ?? '',
            'asked_salary' => $this->otherQuestions->salary,
            'chronic_diseases' => $this->otherQuestions->chronicDiseases,
            'is_pregnant' => $this->otherQuestions->pregnant,
            'family_situation' => $this->familySituation->familySituation,
            'children' => $this->familySituation->children,
        ]);
    }

    public function storeCandidateEducationDetail(): void
    {
        CandidateEducationDetail::query()
            ->create([
                'candidate_id' => $this->id,
                'educational_institution' => $this->studyPeriod->educationalInstitution,
                'direction' => $this->studyPeriod->direction,
                'admission_year' => $this->studyPeriod->admissionYear,
                'field' => $this->studyPeriod->field,
                'graduation_year' => $this->studyPeriod->graduationYear,
            ]);
    }

    public function storeCandidateExperience(): void
    {
        if ($this->workExperience->hasWorkPlace){
            CandidateExperience::query()->create([
                'candidate_id' => $this->id,
                'previous_organization' => $this->workExperience->previousOrganization,
                'reason_for_dismissal' => $this->workExperience->reasonForDismissal?? '',
                'position' => $this->workExperience->position,
                'start' => $this->workExperience->periodEmployment[0],
                'end' => $this->workExperience->periodEmployment[1] ?? null,
            ]);
        }
    }

    public function storeCandidateFamilyMembers(): void
    {
        foreach ($this->aboutFamily as $item) {
            CandidateFamilyMember::query()->create([
                'candidate_id' => $this->id,
                'address' => $item->address,
                'full_name' => $item->fullName,
                'kinship' => $item->kinship,
                'work_place' => $item->workPlace,
            ]);
        }
    }

    public function storeCandidateLangSkills(): void
    {
        foreach ($this->additionalSkillsLanguages as $item) {
            CandidateLangSkill::query()->create([
                'candidate_id' => $this->id,
                'lang' => $item->language,
                'level' => $item->level,
            ]);
        }
    }

    public function storeCandidateOtherSkills(): void
    {
        foreach ($this->additionalSkillsOthers as $item) {
            CandidateOtherSkill::query()->create([
                'candidate_id' => $this->id,
                'name' => $item->skillName,
                'level' => $item->level,
            ]);
        }
    }

    public function storeCandidateSelectedPosition(): void
    {
        foreach ($this->selectPositions as $item) {
            CandidateSelectedPosition::query()->create([
                'candidate_id' => $this->id,
                'name' => $item,
            ]);
        }
    }
}
