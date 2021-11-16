<?php
namespace App\Controller;

use App\Repository\NotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class NotaController extends AbstractController
{
  public function listNotas(NotaRepository $repoNota, $idAlumno)
  {
    //dump($repoNota->getNotasAlumno($idAlumno));
    $notasAlumno = $repoNota->getNotasAlumno($idAlumno);
    $notaMediaAlumno = $repoNota->getNotaMedia($idAlumno);
    return $this->render('twig/listadoNotas.html.twig', array(
      'notasAlumno' => $notasAlumno,
      'notaMediaAlumno' => $notaMediaAlumno
    ));
  }
}
?>
