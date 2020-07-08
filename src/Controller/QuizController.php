<?php

namespace App\Controller;

use App\Entity\Question;
use App\Entity\Quiz;
use App\Entity\Reponse;
use App\Form\QuizType;
use App\Form\QuestionType;
use App\Form\ReponseType;
use App\Repository\QuizRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizController extends AbstractController
{
    /**
     * @Route("/creer-quiz", name="quiz_creerQuiz")
     * @param Request $request
     * @return Response
     */
    public function creerQuiz(Request $request)
    {
        $quiz = new Quiz();
        $quizForm = $this->createForm(QuizType::class, $quiz);
        $quizForm->handleRequest($request);

        if ($quizForm->isSubmitted() && $quizForm->isValid()) {
            //si l'état est privé
            if ($request->get("quiz")['etat']) {
                $quiz->setCleAcces($quiz->generateRandomString());
            }

            //set l'utilisateyur créateur du quiz
            $quiz->setUtilisateurCreateur($this->getUser());

            $entityMangager = $this->getDoctrine()->getManager();
            $entityMangager->persist($quiz);
            $entityMangager->flush();

            return $this->redirectToRoute("quiz_voirQuiz", [
                'idQuiz' => $quiz->getId()
            ]);
        }

        //redirige vers la même page de création de quiz pour modif data non valides
        return $this->render('quiz/creer_quiz.html.twig', [
            'quiz_formulaire' => $quizForm->createView()
        ]);
    }

    /**
     * @Route("/voir-quiz/{idQuiz}", name="quiz_voirQuiz")
     * @param $idQuiz
     * @return Response
     */
    public function voirQuiz($idQuiz, QuizRepository $repository) {
        $quiz = $repository->find($idQuiz);

        $question = new Question();
        $questionForm = $this->createForm(QuestionType::class, $question);

        return $this->render('quiz/creer_questions.html.twig', [
            'quiz' => $quiz,
            'questionFormulaire' => $questionForm->createView()
        ]);
    }

    /**
     * @Route("/form-question", name="quiz_genererFormQuestion")
     */
    public function genererFormQuestion() {
        $question = new Question();
        $questionForm = $this->createForm(QuestionType::class, $question);

        $reponse = new Reponse();
        $reponseForm = $this->createForm(ReponseType::class, $reponse);

        return $this->render('quiz/form_question.html.twig', [
            'questionFormulaire' => $questionForm->createView(),
            'reponseFormulaire' => $reponseForm->createView()
        ]);
    }

    /**
     * @Route("/save-question", name="quiz_enregistrerQuestion")
     * @param Request $request
     * @return Response
     */
    public function enregistrerQuestion(Request $request) {
        $question = new Question();
        $questionForm = $this->createForm(QuestionType::class, $question);
        $questionForm->handleRequest($request);

        if ($questionForm->isValid()) {
            $entityMangager = $this->getDoctrine()->getManager();
            $entityMangager->persist($question);
            $entityMangager->flush();
        }
    }

}
