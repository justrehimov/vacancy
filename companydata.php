<?php
class CompanyData{
    var $id;
    var $companyName;
    var $name;
    var $surname;
    var $email;
    var $phone;
    var $password;
    var $cityId;
    var $aboutCompany;
    var $logo;
    var $dataDate;
    var $active;
    var $website;

    function __construct(
        $id,
        $companyName,
        $name,
        $surname,
        $email,
        $phone,
        $password,
        $cityId,
        $aboutCompany,
        $logo,
        $dataDate,
        $active,
        $website
    )
    {
            $this->id = $id;
            $this->companyName = $companyName;
            $this->name = $name;
            $this->surname = $surname;
            $this->email = $email;
            $this->phone = $phone;
            $this->password = $password;
            $this->cityId = $cityId;
            $this->aboutCompany = $aboutCompany;
            $this->logo = $logo;
            $this->dataDate = $dataDate;
            $this->active = $active;
            $this->website = $website;
    }
}
?>