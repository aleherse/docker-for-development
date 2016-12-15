<?php

use Doctrine\DBAL\Query\QueryBuilder;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

$app = new Silex\Application();

$app->get('/', function () use ($app) {
    $emails = $app['db']->fetchAll('SELECT * FROM `emails`');

    return $app['twig']->render('home.html.twig', [
        'emails' => $emails
    ]);
});

$app->post('/send', function (Request $request) use ($app) {
    $subject = $request->request->get('subject', '');
    $to = $request->request->get('to', '');
    $body = $request->request->get('body', '');

    $message = \Swift_Message::newInstance()
        ->setSubject($subject)
        ->setFrom(['server@dockerfordevelopment.com'])
        ->setTo([$to])
        ->setBody($body);

    $app['mailer']->send($message);

    /** @var QueryBuilder $qb */
    $qb = $app['db']->createQueryBuilder();
    $qb->insert('`emails`')
        ->values([
            '`subject`' => '?',
            '`to`' => '?',
            '`body`' => '?'
        ])
        ->setParameter(0, $subject)
        ->setParameter(1, $to)
        ->setParameter(2, $body)
        ->execute();

    return new RedirectResponse('/');
});

return $app;
