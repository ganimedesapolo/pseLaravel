<?php
namespace App;

/**
* clase para instanciar las personas
 * author: Diego Duran
 * version: 1
 * since : 8/04/2018
 *version : 1
 */
class Person
{
    
   public $document;
   public $documentType; 
   public $firstName; 
   public $lastName;
   public $company; 
   public $emailAddress; 
   public $address;
   public $city; 
   public $province;
   public $country;
   public $phone;
   public $mobile;

  
  function __construct($document, $documentType, $firstName, $lastName, $company, $emailAddress, $address, $city, $province, $country, $phone, $mobile) {		
			
		     $this->document=$document;
		     $this->documentType=$documentType; 
		     $this->firstName=$firstName; 
		     $this->lastName=$lastName; 
		     $this->company=$company; 
		     $this->emailAddress=$emailAddress; 
		     $this->address=$address;
		     $this->city=$city; 
		     $this->province=$province;
		     $this->country=$country;
		     $this->phone=$phone;
		     $this->mobile=$mobile;

		}




}
