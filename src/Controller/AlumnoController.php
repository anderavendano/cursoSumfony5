<?php
namespace App\Controller;

use App\Entity\Alumno;
use App\Repository\AlumnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AlumnoController extends AbstractController
{
  public function listUsuarios(AlumnoRepository $repoAlumno)
  {
    return $this->render('twig/listadoUsuarios.html.twig', array(
      'alumnos' => $repoAlumno->findAll()
    ));
  }

}




?>
