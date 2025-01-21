<?php
header("Content-Type: application/json");

function assessDifficulty($question) {
    // Define keywords with their categories
    $keywords_easy = [
        'definition', 'basic', 'examples', 'explain', 
        'overview', 'list', 'describe', 'identify', 
        'meaning', 'introduction', 'outline', 'purpose',
        'types', 'characteristics', 'principles', 'features'
    ];
    $keywords_moderate = [
        'calculation', 'process', 'compare', 'difference', 
        'analyze', 'interpret', 'application', 'steps', 
        'prepare', 'adjust', 'record', 'entries', 
        'journal', 'ledger', 'trial balance', 'accounts',
        'reconciliation', 'allocation', 'matching', 'provisions',
        'depreciation', 'inventory', 'valuation', 'adjusting'
    ];
    $keywords_complex = [
        'consolidation', 'amortization', 'complex', 'advanced', 
        'subsidiary', 'acquisition', 'goodwill', 'merger', 
        'business combinations', 'joint ventures', 'impairment', 
        'cash flow', 'financial instruments', 'hedging', 
        'derivatives', 'foreign exchange', 'translation', 
        'fair value', 'present value', 'discounting', 
        'lease accounting', 'share-based payments', 
        'deferred tax', 'segment reporting', 'transfer pricing', 
        'earnings per share', 'dilution', 'equity method', 
        'provision for doubtful accounts'
    ];

    // Assign scores for each category
    $score_easy = 1;
    $score_moderate = 3;
    $score_complex = 5;

    // Convert the question to lowercase for case-insensitive matching
    $question = strtolower($question);

    // Initialize total score
    $total_score = 0;

    // Check for occurrences of keywords and calculate scores
    foreach ($keywords_easy as $keyword) {
        if (strpos($question, $keyword) !== false) {
            $total_score += $score_easy;
        }
    }
    foreach ($keywords_moderate as $keyword) {
        if (strpos($question, $keyword) !== false) {
            $total_score += $score_moderate;
        }
    }
    foreach ($keywords_complex as $keyword) {
        if (strpos($question, $keyword) !== false) {
            $total_score += $score_complex;
        }
    }

    // Determine difficulty based on the total score
    if ($total_score >= 10) {
        return 'Complex';
    } elseif ($total_score >= 5) {
        return 'Moderate';
    } else {
        return 'Easy';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $question = $input['question'] ?? '';

    if (!empty($question)) {
        $difficulty = assessDifficulty($question); // Correct function name
        echo json_encode(['difficulty' => $difficulty]);
    } else {
        echo json_encode(['error' => 'No question provided']);
    }
}

?>
