<?php
/**
 * カスタム関数群
 */
class CHelper
{
	/**
	 * Shortcut htmlspecialchars.
	 */
	function h ( $string, $quote_style = ENT_COMPAT, $charset = null )
	{
		return htmlspecialchars($string, $quote_style, $charset);
	}

	/**
	 * Shortcut stripslashes.
	 */
	function ss ( $string )
	{
		if ( get_magic_quotes_gpc() )
		{
			$string = stripslashes( $string );
		}

		return $string;
	}

	/**
	 * Shortcut addslashes
	 */
	function ad ( $string )
	{
		if ( !get_magic_quotes_gpc() )
		{
			$string = addslashes( $string );
		}

		return $string;
	}

	/**
	 * $dataに$keyプロパティがセットされている場合値を返します。
	 * @param $data 対象
	 * @param $key キー値
	 * @param $default 存在しない場合に返す値
	 * @return unknown_type
	 */
	function get ( $data, $key, $default = null )
	{
		if (isset($data[$key]))
		{
			return $data[$key];
		}

		return $default;
	}

	/**
	 * checkedを出力する
	 * @param $data1 対象
	 * @param $value チェックボックス等のvalue
	 * @return string|null
	 */
	function checked ( $data, $value )
	{
		if (!is_null($data))
		{
			if (is_array($data))
			{
				if (in_array($value, $data))
				{
					return "checked";
				}
			}
			else if ($data == $value)
			{
				return "checked";
			}
		}

		return null;
	}

	/**
	 * hiddenタグ生成
	 * @param $data 対象
	 * @param $key name属性
	 * @return string
	 */
	function hidden ( $data, $key = null, $array = false )
	{
		$hidden="";

		if (!empty($data))
		{
			foreach ($data as $k => $v)
			{
				$fieldName = $k;

				if (!is_null($key) && $key != "")
				{
					if ($array)
					{
						$fieldName = $key . "[$k]";
					}
					else
					{
						$fieldName = $key.$k;
					}
				}

				if (is_array($v))
				{
					$hidden .= $this->hidden($v, $fieldName, true);
				}
				else
				{
					$hidden .= "<input type=\"hidden\" value=\"{$v}\" name=\"{$fieldName}\" />";
				}
			}
		}

		return $hidden;
	}

	/**
	 * mailto:URLを生成します。
	 * @param $to 宛先
	 * @param $subject メールタイトル
	 * @param $body メール本文
	 * @param $from_encoding 文字エンコーディング
	 * @param $is_softbank softbank携帯用
	 */
	function mailToUrl ( $to, $subject = "", $body = "", $from_encoding = 'auto', $is_softbank = FALSE )
	{
		$format = "mailto:%s?subject=%s&body=%s";

		$to_encoding = "SJIS-win";

		if ($is_softbank)
		{
			$to_encoding = "UTF-8";
		}

		if (!is_null($subject) && $subject != "")
		{
			$subject = rawurlencode(mb_convert_encoding($subject, $to_encoding, $from_encoding));
		}

		if (!is_null($body) && $body != "")
		{
			$body = rawurlencode(mb_convert_encoding($body, $to_encoding, $from_encoding));

			$tmp = sprintf($format, $to, $subject, "");

			$length = $this->bstrlen($tmp);

			$limit = $is_softbank ? 1300 : 1024;

			$limit = ($limit - $length);

			// Bodyのbyte数をカウント
			if ($this->bstrlen($body) >= $limit)
			{
				// URLencode済みの文字列長がlimit以内で切り出す
				$body = $this->splitUrlencodeStr(rawurldecode($body), $limit, $to_encoding, $from_encoding);
			}
		}

		$href = sprintf($format, $to, $subject, $body);

//		// URL長さ調節
//		if ($this->bstrlen($href) > 1024)
//		{
//			$format = 'mailto:%s?subject=%s&body=';
//			$limit = (1024 - $this->bstrlen(sprintf($format, $to, $subject)));
//
//			if ($limit <= 0)
//			{
//				// エラー吐きやがれ
//				return $href;
//			}
//
//			$body = $this->splitUrlencodeStr(rawurldecode($body), $limit, $to_encoding, $from_encoding);
//
//			$href .= $body;
//		}

		return $href;
	}

	/**
	 * 文字列をURLEncodeされたものをByte単位で切り出します。
	 * （マルチバイト考慮のため端数は切り捨てる。）
	 * @param string $str 対象
	 * @param int $len byte数
	 */
	function splitUrlencodeStr ( $str, $len )
	{
		$res = "";

		for ($i = 0; $i < mb_strlen($str); $i++)
		{
			$split_str = rawurlencode($str[$i]);

			if ($this->bstrlen($res . $split_str) >= $len)
			{
				break;
			}

			$res .= $split_str;
		}

		return $res;
	}

	/**
	 * 文字列のbyte長を返します
	 * @param string $str 対象
	 * @return int byte数
	 */
	function bstrlen ( $str )
	{
	    return (strlen(bin2hex($str)) / 2);
	}

	/**
	 * HTML用のOption配列を生成します
	 * @param array $data 配列
	 * @param unknown_type $options オプション要素
	 * @return string Htmltag
	 */
	function createHtmlOptions ( $data, $options = array() )
	{
		$ret = "";
		$format = "<option value=\"%s\" %s >%s</option>";
		$selected_key = null;

		if (!is_array($options))
		{
			$selected = $options;
			unset($options);

			$options = array('selected' => $selected);
			unset($selected);
		}

		if ($data && is_array($data))
		{
			if ($options['empty'])
			{
				$ret .= sprintf($format, "", "", $options['empty']);
			}

			if (isset($options['selected']))
			{
				$selected_key = $options['selected'];
			}

			if (isset($options['value']) && isset($options['title']))
			{
				foreach ($data as $row)
				{
					$selected = "";

					if ($selected_key && $selected_key == $row[$options['value']])
					{
						$selected = 'selected';
					}

					$ret .= sprintf($format, $row[$options['value']], $selected, $options['title']);
				}
			}
			else
			{
				foreach ($data as $k => $v)
				{
					$selected = "";

					if ($selected_key && $selected_key == $k)
					{
						$selected = 'selected';
					}

					$ret .= sprintf($format, $k, $selected, $v);
				}
			}
		}

		return $ret;
	}
}
