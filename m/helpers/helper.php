<?php
/**
 * �J�X�^���֐��Q
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
	 * $data��$key�v���p�e�B���Z�b�g����Ă���ꍇ�l��Ԃ��܂��B
	 * @param $data �Ώ�
	 * @param $key �L�[�l
	 * @param $default ���݂��Ȃ��ꍇ�ɕԂ��l
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
	 * checked���o�͂���
	 * @param $data1 �Ώ�
	 * @param $value �`�F�b�N�{�b�N�X����value
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
	 * hidden�^�O����
	 * @param $data �Ώ�
	 * @param $key name����
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
	 * mailto:URL�𐶐����܂��B
	 * @param $to ����
	 * @param $subject ���[���^�C�g��
	 * @param $body ���[���{��
	 * @param $from_encoding �����G���R�[�f�B���O
	 * @param $is_softbank softbank�g�їp
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

			// Body��byte�����J�E���g
			if ($this->bstrlen($body) >= $limit)
			{
				// URLencode�ς݂̕����񒷂�limit�ȓ��Ő؂�o��
				$body = $this->splitUrlencodeStr(rawurldecode($body), $limit, $to_encoding, $from_encoding);
			}
		}

		$href = sprintf($format, $to, $subject, $body);

//		// URL��������
//		if ($this->bstrlen($href) > 1024)
//		{
//			$format = 'mailto:%s?subject=%s&body=';
//			$limit = (1024 - $this->bstrlen(sprintf($format, $to, $subject)));
//
//			if ($limit <= 0)
//			{
//				// �G���[�f���₪��
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
	 * �������URLEncode���ꂽ���̂�Byte�P�ʂŐ؂�o���܂��B
	 * �i�}���`�o�C�g�l���̂��ߒ[���͐؂�̂Ă�B�j
	 * @param string $str �Ώ�
	 * @param int $len byte��
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
	 * �������byte����Ԃ��܂�
	 * @param string $str �Ώ�
	 * @return int byte��
	 */
	function bstrlen ( $str )
	{
	    return (strlen(bin2hex($str)) / 2);
	}

	/**
	 * HTML�p��Option�z��𐶐����܂�
	 * @param array $data �z��
	 * @param unknown_type $options �I�v�V�����v�f
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
