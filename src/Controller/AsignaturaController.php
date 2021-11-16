<?php
namespace App\Controller;


use App\Repository\AsignaturaRepository;
use App\Repository\AlumnoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AsignaturaController extends AbstractController
{
  public function listAsignaturas(AsignaturaRepository $repoAsig, $idAlumno)
  {
    $asignaturasAlumno=$repoAsig->getAsignaturasAlumno($idAlumno);
    $asignaturas=$repoAsig->findAll();

    foreach ($asignaturasAlumno as $keyAsignaturasAlumno => $asignaturaAlumno)
    {
      foreach ($asignaturas as $keyAsignatura => $asignatura)
      {
        if($asignatura->getId() == $asignaturaAlumno->getId()){
          unset($asignaturas[$keyAsignatura]);
        }
      }
    }

    return $this->render('twig/listadoAsignaturas.html.twig', array(
      'asignaturasAlumno' => $asignaturasAlumno,
      'idAlumno' => $idAlumno,
      'asignaturasMatri' => $asignaturas
    ));
  }

  public function desmaAsignatura(AsignaturaRepository $repoAsig, AlumnoRepository $repoAlum, $idAsig, $idAlumno)
  {
    $em = $this->getDoctrine()->getManager();
    $asignatura = $repoAsig->findOneById($idAsig);
    $alumno = $repoAlum->findOneById($idAlumno);
    $asignatura->removeAlumno($alumno);
    $em->persist($asignatura);
    $em->flush();
    //$repoAsig->deleteAsignaturaAlumno($idAsig, $idAlumno);
  /*$response = $this->forward('App\Controller\AsignaturaController::listAsignaturas', [
       'idAlumno'  => $idAlumno*/
   return $this->redirectToRoute('asignaturas_alumno', ['idAlumno'=>$idAlumno]);
  // return $response;
  }

  public function matriAsignatura(AsignaturaRepository $repoAsig, AlumnoRepository $repoAlum, $idAsig, $idAlumno)
  {
    $em = $this->getDoctrine()->getManager();
    $asignatura = $repoAsig->findOneById($idAsig);
    $alumno = $repoAlum->findOneById($idAlumno);
    $asignatura->addAlumno($alumno);
    $em->persist($asignatura);
    $em->flush();
    //$repoAsig->deleteAsignaturaAlumno($idAsig, $idAlumno);
    /*$response = $this->forward('App\Controller\AsignaturaController::listAsignaturas', [
       'idAlumno'  => $idAlumno
   ]);
   return $response;*/
  // $this->generateUrl('asignaturas_alumno', ['idAlumno'=>$idAlumno], UrlGeneratorInterface::ABSOLUTE_PATH);
  return $this->redirectToRoute('asignaturas_alumno', ['idAlumno'=>$idAlumno]);
  }
}




?>
