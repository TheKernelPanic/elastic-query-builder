<?php
declare(strict_types=1);

namespace ElasticQueryBuilder\Common;

trait RewriteParameter
{
    /**
     * @var string
     */
    protected string $rewrite;

    /**
     * @return $this
     */
    public function constantScoreBoolean()
    {
        $this->rewrite = 'constant_score_boolean';

        return $this;
    }

    /**
     * @return $this
     */
    public function scoringBoolean()
    {
        $this->rewrite = 'scoring_boolean';

        return $this;
    }

    /**
     * @return $this
     */
    public function topTermsBlendedFreqs()
    {
        $this->rewrite = 'top_terms_blended_freqs_N';

        return $this;
    }

    /**
     * @return $this
     */
    public function topTermsBoost()
    {
        $this->rewrite = 'top_terms_boost_N';

        return $this;
    }

    /**
     * @return $this
     */
    public function topTerms()
    {
        $this->rewrite = 'top_terms_N';

        return $this;
    }
}