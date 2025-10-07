<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $brand_name
 * @property string|null $website
 * @property array $social_links
 * @property string|null $sector
 * @property int|null $years_active
 * @property string|null $brand_summary
 * @property string|null $target_audience
 * @property array<array-key, mixed>|null $priority_goals
 * @property string|null $competitor_analysis
 * @property string|null $market_position
 * @property string|null $three_words
 * @property string|null $strength
 * @property string|null $edge_against_competitors
 * @property string|null $weakness
 * @property bool|null $has_social_management
 * @property bool|null $outsourced_social
 * @property array<array-key, mixed>|null $marketing_tools
 * @property string|null $logo_satisfaction
 * @property array<array-key, mixed>|null $corporate_assets
 * @property bool|null $has_media_assets
 * @property string|null $design_representation
 * @property bool|null $has_website
 * @property string|null $is_mobile_ready
 * @property string|null $has_seo
 * @property string|null $web_performance_feedback
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property string|null $preferred_contact
 * @property string|null $heard_from
 * @property string $status
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read string|null $design_representation_label
 * @property-read string|null $has_seo_label
 * @property-read string|null $heard_from_label
 * @property-read string|null $is_mobile_ready_label
 * @property-read string|null $logo_satisfaction_label
 * @property-read string|null $preferred_contact_label
 * @property-read string $status_label
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief completed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief inReview()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief pending()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereBrandName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereBrandSummary($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereCompetitorAnalysis($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereCorporateAssets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereDesignRepresentation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereEdgeAgainstCompetitors($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereFullName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereHasMediaAssets($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereHasSeo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereHasSocialManagement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereHasWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereHeardFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereIsMobileReady($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereLogoSatisfaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereMarketPosition($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereMarketingTools($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereOutsourcedSocial($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief wherePreferredContact($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief wherePriorityGoals($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereSector($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereSocialLinks($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereStrength($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereTargetAudience($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereThreeWords($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereUserAgent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereWeakness($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereWebPerformanceFeedback($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereWebsite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|BrandBrief whereYearsActive($value)
 */
	class BrandBrief extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $subject
 * @property string $message
 * @property bool $is_read
 * @property \Illuminate\Support\Carbon|null $read_at
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact read()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact unread()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereIsRead($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereReadAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Contact whereUserAgent($value)
 */
	class Contact extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $surname
 * @property string $phone
 * @property string $company_name
 * @property string $company_phone
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCompanyPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereSurname($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Customer withoutTrashed()
 */
	class Customer extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $type
 * @property string $to_email
 * @property string $subject
 * @property string|null $content
 * @property array<array-key, mixed>|null $data
 * @property string $status
 * @property string|null $error_message
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Illuminate\Support\Carbon|null $sent_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $status_label
 * @property-read mixed $type_label
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog byType($type)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog failed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog successful()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereErrorMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereIpAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereSentAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereSubject($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereToEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|EmailLog whereUserAgent($value)
 */
	class EmailLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $question
 * @property string $answer
 * @property string $slug
 * @property int $sort_order
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faq withoutTrashed()
 */
	class Faq extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $news_category_id
 * @property string $img
 * @property string $title
 * @property string $slug
 * @property string $desc
 * @property string $seo_title
 * @property string $seo_key
 * @property string $seo_desc
 * @property int $is_active
 * @property int $is_home
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\NewsCategory|null $news_category
 * @method static \Illuminate\Database\Eloquent\Builder|News newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|News query()
 * @method static \Illuminate\Database\Eloquent\Builder|News whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereNewsCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSeoDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSeoKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|News whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\NewsGallery> $galleries
 * @property-read int|null $galleries_count
 * @property-read mixed $category
 * @property-read mixed $content
 * @property-read mixed $featured_image
 */
	class News extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $img
 * @property string $title
 * @property string $slug
 * @property string|null $seo_title
 * @property string|null $seo_key
 * @property string|null $seo_desc
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $category_news_count
 * @property-read mixed $name
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\News> $news
 * @property-read int|null $news_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereSeoDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereSeoKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|NewsCategory whereUpdatedAt($value)
 */
	class NewsCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $news_id
 * @property string $img
 * @property int $order_number
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\News|null $news
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereNewsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NewsGallery whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class NewsGallery extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $img Sayfa kapak görseli
 * @property string $title Sayfa başlığı
 * @property string $slug SEO dostu URL
 * @property string $desc Sayfa içeriği
 * @property string|null $seo_title SEO başlık
 * @property string|null $seo_key SEO anahtar kelimeler
 * @property string|null $seo_desc SEO açıklama
 * @property bool $is_active Aktif/Pasif durumu
 * @property int $sort_order Sıralama
 * @property \Illuminate\Support\Carbon|null $published_at Yayın tarihi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\PageGallery> $galleries
 * @property-read int|null $galleries_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page ordered()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page published()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereSeoDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereSeoKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Page withoutTrashed()
 */
	class Page extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $page_id
 * @property string $image Galeri görseli
 * @property int $sort_order Sıralama
 * @property bool $is_active Aktif/Pasif durumu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read \App\Models\Page $page
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery whereImage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery wherePageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|PageGallery whereUpdatedAt($value)
 */
	class PageGallery extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $img
 * @property string $title
 * @property string $slug
 * @property string|null $desc
 * @property string|null $url
 * @property string|null $seo_title
 * @property string|null $seo_key
 * @property string|null $seo_desc
 * @property bool $is_active
 * @property bool $is_home
 * @property int|null $sort_order
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ReferenceGallery> $galleries
 * @property-read int|null $galleries_count
 * @property-read mixed $formatted_created_at
 * @property-read mixed $formatted_updated_at
 * @property-read mixed $limited_services_text
 * @property-read mixed $primary_service
 * @property-read mixed $services_text
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference home()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereSeoDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereSeoKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Reference withoutTrashed()
 */
	class Reference extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $reference_id
 * @property string $img
 * @property string|null $order_number
 * @property int $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Reference $reference
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery whereOrderNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery whereReferenceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ReferenceGallery whereUpdatedAt($value)
 */
	class ReferenceGallery extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $guard_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereGuardName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Role withoutPermission($permissions)
 */
	class Role extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $service_category_id
 * @property string|null $img Hizmet kapak görseli
 * @property string $title Hizmet başlığı
 * @property string $slug SEO dostu URL
 * @property string $desc Hizmet içeriği
 * @property string|null $seo_title SEO başlık
 * @property string|null $seo_key SEO anahtar kelimeler
 * @property string|null $seo_desc SEO açıklama
 * @property bool $is_active Aktif/Pasif durumu
 * @property bool $is_home Anasayfada göster
 * @property int $sort_order Sıralama
 * @property \Illuminate\Support\Carbon|null $published_at Yayın tarihi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ServiceGallery> $galleries
 * @property-read int|null $galleries_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Reference> $references
 * @property-read int|null $references_count
 * @property-read \App\Models\ServiceCategory $service_category
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereIsHome($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSeoDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSeoKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereServiceCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Service withoutTrashed()
 */
	class Service extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $img Kategori kapak görseli
 * @property string $title Kategori başlığı
 * @property string $slug SEO dostu URL
 * @property string|null $desc Kategori açıklaması
 * @property string|null $seo_title SEO başlık
 * @property string|null $seo_key SEO anahtar kelimeler
 * @property string|null $seo_desc SEO açıklama
 * @property bool $is_active Aktif/Pasif durumu
 * @property int $sort_order Sıralama
 * @property \Illuminate\Support\Carbon|null $published_at Yayın tarihi
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Service> $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSeoDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSeoKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSeoTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceCategory withoutTrashed()
 */
	class ServiceCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $service_id
 * @property string $img Galeri görseli
 * @property string|null $title Görsel başlığı
 * @property int $sort_order Sıralama
 * @property bool $is_active Aktif/Pasif durumu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Service $service
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereServiceId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ServiceGallery withoutTrashed()
 */
	class ServiceGallery extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string|null $value
 * @property string|null $type
 * @property string $group
 * @property string|null $options
 * @property bool $is_public
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read array $options_array
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereGroup($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereIsPublic($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereOptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Setting whereValue($value)
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $img
 * @property string $title
 * @property string $description
 * @property int $type_id
 * @property string|null $type_content
 * @property int $is_active
 * @property int $sort_order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\News|null $news
 * @property-read \App\Models\Page|null $page
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereImg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSortOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTypeContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read mixed $type_name
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider active()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Slider ordered()
 */
	class Slider extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription query()
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Subscription whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Subscription extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property string|null $avatar
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $last_login_at
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastLoginAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

