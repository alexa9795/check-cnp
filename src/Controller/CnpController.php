<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\DataFormType;
use App\Service\CnpService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CnpController extends AbstractController
{
    /**
     * @param Request $request
     * @return Response
     */
    public function checkCNP(CnpService $cnpService, Request $request)
    {
        $dataForm = $this->createForm(DataFormType::class);

        $dataForm->handleRequest($request);

        if ($dataForm->isSubmitted() && $dataForm->isValid()) {
            $data = $dataForm->getData();

            /* validate form data */
            foreach($data as $key => $value) {
                if ($key === 'dateOfBirth') {
                    continue;
                }
                $data[$key] = trim($data[$key]);
                $data[$key] = stripslashes($data[$key]);
                $data[$key] = htmlspecialchars($data[$key]);
            }

            $person = (new Person())->setName($data['name'])
                ->setGender($data['gender'])
                ->setDateOfBirth($data['dateOfBirth'])
                ->setNationality($data['nationality'])
                ->setIsRomanianResident($data['isRomanianResident'])
                ->setCounty($data['county'])
                ->setCnp($data['cnp']);

            $this->addFlash('result', $cnpService->isCnpValid($person));
        }

        return $this->render(
            'data.html.twig',
            [
                'dataForm' => $dataForm->createView(),
            ]
        );
    }
}
