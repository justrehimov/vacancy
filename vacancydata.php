<?php
    class VacancyData {
        var $id;
        var $activeStatus;
        var $companyId;
        var $dateCreated;
        var $name;
        var $salary;
        var $categoryId;
        var $workModeId;
        var $educationId;
        var $experienceId;
        var $ageId;
        var $expirationDate;
        var $information;
        var $requirements;
        var $address;

        function __construct(
            $id,
            $activeStatus,
            $companyId,
            $dateCreated,
            $name,
            $salary,
            $categoryId,
            $workModeId,
            $experienceId,
            $educationId,
            $ageId,
            $expirationDate,
            $information,
            $requirements,
            $address
        ) {
            $this->id = $id;
            $this->activeStatus = $activeStatus;
            $this->companyId = $companyId;
            $this->dateCreated = $dateCreated;
            $this->name = $name;
            $this->salary = $salary;
            $this->categoryId = $categoryId;
            $this->workModeId = $workModeId;
            $this->educationId = $educationId;
            $this->experienceId = $experienceId;
            $this->ageId = $ageId;
            $this->expirationDate = $expirationDate;
            $this->information = $information;
            $this->requirements = $requirements;
            $this->address = $address;
        }
    }
?>