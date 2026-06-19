<?php

/**
 * Site metadata and description generator.
 *
 * Provides a structured way to store site metadata and generate
 * short descriptive texts based on the provided information.
 */

class SiteMeta
{
    private $title;
    private $description;
    private $keywords;
    private $urls;
    private $author;

    public function __construct($title, $description, $keywords, $urls, $author = '')
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
        $this->urls = $urls;
        $this->author = $author;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getKeywords()
    {
        return $this->keywords;
    }

    public function getUrls()
    {
        return $this->urls;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Generate a short descriptive text from metadata.
     *
     * @return string
     */
    public function generateShortDescription()
    {
        $parts = [];

        if (!empty($this->title)) {
            $parts[] = $this->title;
        }

        if (!empty($this->description)) {
            $parts[] = $this->description;
        }

        if (!empty($this->keywords)) {
            $parts[] = 'Keywords: ' . implode(', ', array_slice($this->keywords, 0, 3));
        }

        if (!empty($this->urls)) {
            $parts[] = 'URLs: ' . implode(', ', array_slice($this->urls, 0, 2));
        }

        if (!empty($this->author)) {
            $parts[] = 'Author: ' . $this->author;
        }

        $shortDescription = implode(' | ', $parts);

        return $shortDescription;
    }

    public static function fromArray($data)
    {
        return new self(
            $data['title'] ?? '',
            $data['description'] ?? '',
            $data['keywords'] ?? [],
            $data['urls'] ?? [],
            $data['author'] ?? ''
        );
    }
}

// Example usage
$siteData = [
    'title' => '乐鱼体育',
    'description' => 'Official sports information and entertainment platform.',
    'keywords' => ['乐鱼体育', 'sports', 'entertainment', 'live', 'games'],
    'urls' => ['https://h5-wap-leyu.com.cn', 'https://www.leyusports.com'],
    'author' => 'Admin',
];

$siteMeta = SiteMeta::fromArray($siteData);
echo htmlspecialchars($siteMeta->generateShortDescription(), ENT_QUOTES, 'UTF-8');

// Another example
$anotherSite = new SiteMeta(
    '乐鱼体育 Official',
    'Your ultimate sports destination',
    ['乐鱼体育', 'sports news', 'match results'],
    ['https://h5-wap-leyu.com.cn'],
    'Content Team'
);

echo "\n" . htmlspecialchars($anotherSite->generateShortDescription(), ENT_QUOTES, 'UTF-8');