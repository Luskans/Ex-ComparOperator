<?php

///// FONCTIONS UTILITAIRES POUR LES FILTRES
function sumDestinationPrices($destination) { // Somme des prix d'une destination
    return array_reduce($destination, function ($total, $dest) {
        return $total + $dest['price'];
    }, 0);
}

function averageOperatorScores($operator) { // Moyenne des scores d'un operator
    $scores = $operator['scores'];
    $total = 0;
    $count = count($scores);
    if ($count === 0) { // Évite la division par zéro
        return 0;
    }
    foreach ($scores as $score) {
        $total += $score['value'];
    }
    return $total /$count;
}

function numberOperatorReviews($operator) {
    $reviews = $operator['reviews'];
    $count = count($reviews);
    return $count;
}

function sortOperatorsByPriceUp($operator1, $operator2) { // Tri prix total up
    $sum1 = sumDestinationPrices($operator1['destination']);
    $sum2 = sumDestinationPrices($operator2['destination']);
    return $sum1 - $sum2;
}

function sortOperatorsByPriceDown($operator1, $operator2) { // Tri prix total down
    $sum1 = sumDestinationPrices($operator1['destination']);
    $sum2 = sumDestinationPrices($operator2['destination']);
    return $sum2 - $sum1;
}

function sortOperatorsByScoreUp($operator1, $operator2) { // Tri moyenne score up
    $avg1 = averageOperatorScores($operator1);
    $avg2 = averageOperatorScores($operator2);
    return $avg1 - $avg2;
}

function sortOperatorsByScoreDown($operator1, $operator2) { // Tri moyenne score down
    $avg1 = averageOperatorScores($operator1);
    $avg2 = averageOperatorScores($operator2);
    return $avg2 - $avg1;
}

function sortOperatorsByReviewUp($operator1, $operator2) { // Tri nombre commentaires up
    $nb1 = numberOperatorReviews($operator1);
    $nb2 = numberOperatorReviews($operator2);
    return $nb1 - $nb2;
}

function sortOperatorsByReviewDown($operator1, $operator2) { // Tri nombre commentaires down
    $nb1 = numberOperatorReviews($operator1);
    $nb2 = numberOperatorReviews($operator2);
    return $nb2 - $nb1;
}