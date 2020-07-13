<?

namespace app\helpers;

use yii\helpers\Url;

class BreadcrumbsHelper 
{
	public static function category($cat, $last_link = true)
	{

		if ($cat && !$last_link) $arr[] = ['label' => $cat->name];
		else if ($cat) $arr[] = ['label' => $cat->name, 'url' => Url::to(['/category/parent', 'parent_id' => $cat->id])];

		if (isset($cat->parent)) $arr[] = self::createLinkCategory($cat, $action);
		if (isset($cat->parent->parent)) $arr[] = self::createLinkCategory($cat->parent, $action);
		if (isset($cat->parent->parent->parent)) $arr[] = self::createLinkCategory($cat->parent->parent, $action);

		$arr[] = ['label' => 'Категории', 'url' => '/category/parent'];

		return array_reverse($arr);
	}

	public static function createLinkCategory($cat) 
	{
		$arr['label'] = $cat->parent->name;
		$arr['url'] = Url::to(['/category/parent', 'parent_id' => $cat->parent->id]);
		return $arr;
	}

	public static function text($text_id)
	{
		$arr[] = ['label' => 'Текст', 'url' => Url::to(['/text/view', 'id' => $text_id])];
		$arr[] = ['label' => 'Фразы', 'url' => Url::to(['/text/phrases', 'text_id' => $text_id])];
		$arr[] = ['label' => 'Слова', 'url' => Url::to(['/text/words', 'text_id' => $text_id])];
		return $arr;
	}

}