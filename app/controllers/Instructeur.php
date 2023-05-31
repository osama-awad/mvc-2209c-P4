<?php

class Instructeur extends BaseController
{
    private $InstructeurModel;

    public function __construct()
    {
        $this->InstructeurModel = $this->model('InstructeurModel');
    }
     
    public function index()
    {
        /**haal alle instucteurs op uit de database (model)*/

         $Instructeur = $this->InstructeurModel->getInstructeur();
        /**maak de rows voor de tbody in de view*/
        $rows = "";
        foreach ($Instructeur as $value) {
           
            $datum = date_create($value->DatumInDienst);
            $datum = date_format($datum, 'd-m-y');

            $rows .= "<tr>
                        <td>$value->Voornaam</td>
                        <td>$value->Tussenvoegsel</td>
                        <td>$value->Achternaam</td>
                        <td>$value->Mobiel</td>
                        <td>$datum</td>
                        <td>$value->AantalSterren</td>
                        <td><a href='/Instructeur/gebruiktevoertuigen/$value->instructeurid'><img src='https://www.freeiconspng.com/thumbs/car-icon-png/car-icon-png-25.png' width = '40px'></a></td>
                        </tr>
                      </tr>";
        }
        //**het data array geeft alle*/

        $data = [
            'titleaaa' => 'Instructeurs in dienst:
                                ',
                                'Amountofinstructeurs' => sizeof($Instructeur),

            'rows' =>$rows
        ];


        $this->view('Instructeur/index',$data);
    }


    public function gebruiktevoertuigen($InstructeurId)
    {
    
        $InstructeurId1 = $this->InstructeurModel->getInstructeurId($InstructeurId);
        $InstructeurId2 = $this->InstructeurModel->getInstructeurinfo($InstructeurId);

     //var_dump($InstructeurId1);

    $rows = "";
    foreach ($InstructeurId1 as $value) {
        $rows .= "<tr>
                    <td>$value->TypeVoertuig</td>
                    <td>$value->Type</td>
                    <td>$value->Kenteken</td>
                    <td>$value->Bouwjaar</td>
                    <td>$value->Brandstof</td>
                    <td>$value->Rijbewijscategorie</td>
                    </tr>
                  </tr>";
    }
                  $data = [
                    'titl' => 'Instructeurs in dienst:
                                        ',
                                        'Amountofinstructeurs' => sizeof($InstructeurId1),
                    'VoorNaam' =>$InstructeurId2 -> Voornaam,
                    'Tussenvoegsel' =>$InstructeurId2 -> Tussenvoegsel,
                    'Achternaam' =>$InstructeurId2 -> Achternaam,
                    'DatumInDienst' =>$InstructeurId2 -> DatumInDienst,
                    'AantalSterren' =>$InstructeurId2 -> AantalSterren,

                    
                                                     
                                               
                    'rows' =>$rows
                ];
        
        
                $this->view('Instructeur/Gebruiktevoertuigen',$data);
            }
    









    // {

    //     $InstructeurId = $this->InstructeurModel-> getInstructeurId($InstructeurId);
       
    //     var_dump($InstructeurId);
    //     exit;


    //     $data = [
        
    //     ];

        


    //     $this->view('Instructeur/gebruiktevoertuigen',$data);
    // }


}