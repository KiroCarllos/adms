<?php

namespace App\AI;

class RecommendationModel
{
    function extract_experience_and_employment($cv_url) {
        try {
            $response = file_get_contents($cv_url);
            $html = new DOMDocument();
            @$html->loadHTML($response);
            $xpath = new DOMXPath($html);

            // Example: Extracting experience and employment information from the CV webpage
            $experience = $xpath->query("//div[@class='experience']")->item(0)->nodeValue;
            $employment = $xpath->query("//div[@class='employment']")->item(0)->nodeValue;

            return array($experience, $employment);
        } catch (Exception $e) {
            echo "Error extracting data from $cv_url: " . $e->getMessage();
            return array(null, null);
        }
    }

    function score_candidate($experience, $employment, $required_field) {
        $score = 0;

        // Check if the required field is mentioned in experience or employment
        if (stripos($experience, $required_field) !== false || stripos($employment, $required_field) !== false) {
            $score += 1;
        }

        return $score;
    }

    public static function find_best_candidate($candidate_cv_urls, $required_field) {
        $best_candidate = null;
        $best_score = -1;

        foreach ($candidate_cv_urls as $cv_url) {
            list($experience, $employment) = extract_experience_and_employment($cv_url);

            if ($experience !== null && $employment !== null) {
                $score = score_candidate($experience, $employment, $required_field);
                if ($score > $best_score) {
                    $best_score = $score;
                    $best_candidate = $cv_url;
                }
            }
        }

        return $best_candidate;
    }

    static function getBestRecommended($users){

        $num_candidates =$cv_url=1;
        $candidate_cv_urls = array();
        for ($i = 0; $i < $num_candidates; $i++) {
            $cv_url = readline("CV link for candidate " . ($i+1) . ": ");
            $candidate_cv_urls[] = $cv_url;
        }
        $required_field = $cv_url;
        foreach ($users as $user){
            $point = 0;
            if (!is_null($user->first_cv)) {
                $point = !is_null($user->sec_cv) ? 2 :  1;
            }
            if(!is_null($user)){

                $user->update(["points"=>$point]);
            }
        }


    }
}
