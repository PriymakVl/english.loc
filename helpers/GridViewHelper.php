<?

namespace app\helpers;

use yii\helpers\Html;


class GridViewHelper
{

	public static function btnView($url)
	{
		function ($url) {
			return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', $url);
		}
        
	}
}