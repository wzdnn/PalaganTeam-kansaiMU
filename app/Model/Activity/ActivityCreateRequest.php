<?php

namespace PalaganTeam\MuhKansai\Model\Activity;
class ActivityCreateRequest{
    public ?string $activityName = null;
    public ?string $activityTanggal = null;
    public ?string $activityTimeStart = null;
    public ?string $activityTimeEnd = null;
    public ?string $activityDeskripsi = null;
    public ?string $activityLokasi = null;
    public ?array $activityJudulLink = null;
    public ?array $activityLink = null;
}