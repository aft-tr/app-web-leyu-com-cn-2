<?php

/**
 * Represents a link card with visual metadata.
 */
class LinkCard
{
    private string $url;
    private string $title;
    private string $description;
    private string $imageUrl;
    private string $domain;

    public function __construct(
        string $url,
        string $title,
        string $description = '',
        string $imageUrl = '',
        string $domain = ''
    ) {
        $this->url = $url;
        $this->title = $title;
        $this->description = $description;
        $this->imageUrl = $imageUrl;
        $this->domain = $domain ?: parse_url($url, PHP_URL_HOST);
    }

    /**
     * Render the link card as a safe HTML snippet.
     *
     * @return string
     */
    public function render(): string
    {
        $escapedUrl = htmlspecialchars($this->url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedTitle = htmlspecialchars($this->title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDescription = htmlspecialchars($this->description, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedImageUrl = htmlspecialchars($this->imageUrl, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $escapedDomain = htmlspecialchars($this->domain, ENT_QUOTES | ENT_HTML5, 'UTF-8');

        $imageTag = '';
        if ($this->imageUrl !== '') {
            $imageTag = '<img src="' . $escapedImageUrl . '" alt="' . $escapedTitle . '" class="link-card-image" />';
        }

        return <<<HTML
<div class="link-card">
    <a href="{$escapedUrl}" target="_blank" rel="noopener noreferrer" class="link-card-anchor">
        {$imageTag}
        <div class="link-card-body">
            <span class="link-card-domain">{$escapedDomain}</span>
            <h3 class="link-card-title">{$escapedTitle}</h3>
            <p class="link-card-description">{$escapedDescription}</p>
        </div>
    </a>
</div>
HTML;
    }

    /**
     * Create a sample LinkCard instance for demonstration.
     *
     * @return self
     */
    public static function createSample(): self
    {
        return new self(
            url: 'https://app-web-leyu.com.cn',
            title: '乐鱼体育 - 精彩体育赛事在线观看',
            description: '乐鱼体育为您提供最新最全的体育赛事直播、赛事资讯与专业分析。',
            imageUrl: 'https://app-web-leyu.com.cn/images/logo.png',
            domain: 'app-web-leyu.com.cn'
        );
    }
}

// ------------------------------------------------------------------------
// Example usage (uncomment to test):
// $card = LinkCard::createSample();
// echo $card->render();
// ------------------------------------------------------------------------