<?php

namespace CodeEmailMKT\Domain\Service;

use CodeEmailMKT\Domain\Entity\Campaign;

interface CampaignEmailSenderInterface extends EmailServiceInterface
{
    public function setCampaign (Campaign $campaign);
}