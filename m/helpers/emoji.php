<?php
// 定数定義
if (!defined('MOBILE_TYPE_DOCOMO'))
{
	/**
	 * docomo
	 * @var int
	 */
	define('MOBILE_TYPE_DOCOMO', 1);
}
if (!defined('MOBILE_TYPE_SOFTBANK'))
{
	/**
	 * softbank
	 * @var int
	 */
	define('MOBILE_TYPE_SOFTBANK', 2);
}
if (!defined('MOBILE_TYPE_AU'))
{
	/**
	 * AU
	 * @var int
	 */
	define('MOBILE_TYPE_AU', 3);
}
if (!defined('MOBILE_TYPE_WILLCOM'))
{
	/**
	 * willcom
	 * @var int
	 */
	define('MOBILE_TYPE_WILLCOM', 4);
}
if (!defined('MOBILE_TYPE_LMODE'))
{
	/**
	 * l-mode
	 * @var int
	 */
	define('MOBILE_TYPE_LMODE', 5);
}
if (!defined('MOBILE_TYPE_OTHER'))
{
	/**
	 * other
	 * @var int
	 */
	define('MOBILE_TYPE_OTHER', 6);
}
if (!defined('EMOJI_DATA'))
{
	/**
	 * 絵文字変換表のパス
	 * @var string
	 */
	define('EMOJI_DATA', dirname(__FILE__) . '/emoji/emojix.csv');
}
if (!defined('EMOJI_IMG_DIR'))
{
	/**
	 * その他機種で表示する代替画像
	 * @var string
	 */
	define('EMOJI_IMG_DIR', null);
}

/**
 * 絵文字出力機能を提供します。<br />
 * 参考：<a href="http://www.dspt.net/">dspt.net</a>[ EMOJI TRANS Ver2.3]
 * @author k
 */
class CEmoji
{
	/**
	 * ドコモ→au絵文字変換利用
	 * @var true|false
	 */
	var $is_ie = false;

	/**
	 * ユーザーエージェント
	 * @var string
	 */
	var $ua = null;

	/**
	 * 絵文字変換表
	 * @var array
	 */
	var $emoji_array = array();

	/**
	 * コンストラクタ
	 */
	function CEmoji()
	{
		if (!file_exists(EMOJI_DATA))
		{
			// ファイルが存在しない
			print 'file path "' . EMOJI_DATA . '" not exists!!';
			die();
		}

		$contents = @file(EMOJI_DATA);

		foreach ($contents as $line)
		{
			$line = rtrim($line);
			$this->emoji_array[] = explode(',', $line);
		}
	}

	/**
	 * UAからキャリアを取得します
	 * @param $data
	 */
	function getCareer ($data)
	{
		if(preg_match("/^DoCoMo\/[12]\.0/i", $data))
		{
    		return MOBILE_TYPE_DOCOMO;
		}
		elseif(preg_match("/^(J\-PHONE|Vodafone|MOT\-[CV]980|SoftBank)\//i", $data))
		{
    		return MOBILE_TYPE_SOFTBANK;
		}
		elseif(preg_match("/^KDDI\-/i", $data) || preg_match("/UP\.Browser/i", $data))
		{
    		return MOBILE_TYPE_AU;
		}
		// 今回は使用しないためコメントアウト
//		elseif(preg_match("/^PDXGW/i", $data) || preg_match("/(DDIPOCKET|WILLCOM);/i", $data))
//		{
//    		return MOBILE_TYPE_WILLCOM;
//		}
//		elseif(preg_match("/^L\-mode/i", $data))
//		{
//    		return MOBILE_TYPE_LMODE;
//		}

    	return MOBILE_TYPE_OTHER;

	}

	/**
	 * 絵文字データを出力します。
	 * @param $code 絵文字コード
	 * @return string
	 */
	function put ($code)
	{
		// validate code
		if (!is_numeric($code) || $code > count($this->emoji_array) + 1)
		{
			return null;
		}

		if (!$this->ua)
		{
			$this->ua = $_SERVER["HTTP_USER_AGENT"];
		}

		$emoji = null;

		switch ($this->getCareer($this->ua))
		{
			case MOBILE_TYPE_DOCOMO:
				$emoji = $this->getEmojiByDocomo($code);
				break;
			case MOBILE_TYPE_AU:
				$emoji = $this->getEmojiByAu($code);
				break;
			case MOBILE_TYPE_SOFTBANK:
				$emoji = $this->getEmojiBySoftbank($code);
				break;
			default:
				$emoji = $this->getEmojiImgTag($code);
				break;
		}

		return $emoji;
	}

	/**
	 * ドコモの絵文字を取得します。
	 * @param $code 絵文字コード
	 * @return string|null
	 */
	function getEmojiByDocomo ($code)
	{
		$ret = null;

		if (isset($this->emoji_array[$code][1]))
		{
			$ret = $this->emoji_array[$code][1];
		}

		return $ret;
	}

	/**
	 * AUの絵文字を取得します。
	 * @param $code 絵文字コード
	 * @return string|null
	 */
	function getEmojiByAu ($code)
	{
		$ret = null;

		if (isset($this->emoji_array[$code][2]))
		{
			if (preg_match("/[^0-9]/", $this->emoji_array[$code][2]))
			{
				$ret = $this->emoji_array[$code][2];
			}
			else if ($this->is_ie)
			{
				$ret = $this->getEmojiByDocomo($code);
			}
			else
			{
				$ret = "<img localsrc=\"".$this->emoji_array[$code][2]."\" style=\"vertical-align:bottom;margin-top:3px;\" />";
			}
		}

		return $ret;
	}

	/**
	 * ソフトバンクの絵文字を取得します
	 * @param $code 絵文字コード
	 * @return string|null
	 */
	function getEmojiBySoftbank ($code)
	{
		$ret = null;

		if (isset($this->emoji_array[$code][3]))
		{
			if (preg_match("/^[A-Z]{1}?/", $this->emoji_array[$code][3]))
			{
				$ret = "\x1B\$" . mb_convert_encoding($this->emoji_array[$code][3], "SJIS", "auto") . "\x0F";
			}
			else
			{
				$ret = mb_convert_encoding($this->emoji_array[$code][3], "SJIS", "auto");
			}
		}

		return $ret;
	}

	/**
	 * その他の機種用の絵文字画像を取得します
	 * @param $code 絵文字コード
	 * @return string|null
	 */
	function getEmojiImgTag ($code)
	{
		$ret = null;

		if (isset($this->emoji_array[$code][0]) && EMOJI_IMG_DIR != null && is_dir(EMOJI_IMG_DIR))
		{
			$ret = "<img src=\"" . EMOJI_IMG_DIR . $this->emoji_array[$code][0] . ".gif\" width=\"12\" height=\"12\" border=\"0\" alt=\"\" />";
		}

		return $ret;
	}
}
