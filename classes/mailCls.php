<?php
/*
*	This script is an extensions of original libMail by Leo West
*
*	Original script by Leo West - west_leo@yahoo.com
*	Original URL: http://lwest.free.fr/doc/php/lib/Mail/
*	Original Lastmod : Nov 2001
*	Original Version : 1.3
*
*	Modified by Setec Astronomy - setec@freemail.it
*	Modified URL : http://digilander.iol.it/setecastronomy/
*	Modified Lastmod : Sep 2004
*	Modified Version : 1.4.1
*
*	Modified by Pier Luigi Pau - eregilofdarkwood@yahoo.com
*	Modified Lastmod : Feb 2008
*	Modified Version : 1.6.0
*
*	This script is distributed under the GPL License
*
*	This program is distributed in the hope that it will be useful,
*	but WITHOUT ANY WARRANTY; without even the implied warranty of
*	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
* 	GNU General Public License for more details.
*
*	http://www.gnu.org/licenses/gpl.txt
*
*/

class Mail
{
	var $sendtoex = array();
	var $sendto = array();
	var $acc = array();
	var $abcc = array();
	var $attachments = array();
	var $related = array();
	var $xheaders = array();
	var $priorities = array(
		1 => '1 (Highest)',
		2 => '2 (High)',
		3 => '3 (Normal)',
		4 => '4 (Low)',
		5 => '5 (Lowest)'
	);
	var $charset = "us-ascii";
	var $ctencoding = "7bit";
	var $boundary;
	var $lev2_boundary;
	var $rel_boundary;
	var $html;
	var $body;
	var $mainctype;
	var $receipt = 0;
	var $headers;
	var $gheaders;

	/*function Mail () { 
		$this->boundary= "--" . md5(uniqid("myboundary".rand())) . "x";
		$this->lev2boundary = null;
	}*/

	function Subject ($subject = "") { 
		$this->xheaders['Subject'] = strtr ($subject, "\r\n" , "  "); 
		return true;
	}

	function From ($from_email, $from_name = "") {
		if (!is_string ($from_email)) {
			return false;
		}

		if (empty ($from_name)) {
			$this->xheaders['From'] = $from_email;
		} else {
			$this->xheaders['From'] = "\"$from_name\" <$from_email>";
		}

		return true;
	}

	function ReplyTo ($replyto_email, $replyto_name = "") {
		if (!is_string ($replyto_email)) {
			return false;
		}

		if (empty ($replyto_name)) {
			$this->xheaders['Reply-To'] = $replyto_email;
		} else {
			$this->xheaders['Reply-To'] = "\"$replyto_name\" <$replyto_email>";
		}

		return true;
	}

	function ReturnPath ($returnpath_email, $returnpath_name = "") {
		if (!is_string ($returnpath_email)) {
			return false;
		}

		if (empty ($returnpath_email)) {
			$this->xheaders['Return-Path'] = $returnpath_email;
		} else {
			$this->xheaders['Return-Path'] = "\"$returnpath_name\" <$returnpath_email>";
		}

		return true;
	}

	function Receipt($flag = true) {
		$this->receipt = ($flag)? 1 : 0;
		return true;
	}

	function To ($address) {
		if (is_array ($address)) {
			$this->sendto = array ();
			$this->sendtoex = array ();
			foreach ($address as $key => $value) {
				if (is_numeric ($key)) {
					$this->sendto[] = $value;
					$this->sendtoex[] = $value;
				} elseif (is_string ($key) && is_string ($value)) {
					$value = trim (str_replace('"', '', $value));
					$this->sendto[] = $key;
					$this->sendtoex[] = "\"$value\" <$key>";
				}
			}
		} else {
			$this->sendto[] = $address;
			$this->sendtoex[] = $address;
		}
		return true;
	}

	function Cc ($address) {
		if (is_array ($address)) { 
			$this->acc = array ();
			foreach ($address as $key => $value) {
				if (is_numeric ($key)) {
					$this->acc[] = $value;
				} elseif (is_string ($key) && is_string ($value)) {
					$value = str_replace('"', '', $value);
					$this->acc[] = "\"$value\" <$key>";
				}
			}
		} else {
			$this->acc = array ($address);
		}
		return true;
	}

	function Bcc ($address) {
		if (is_array ($address)) {
			$this->abcc = array ();
			foreach ($address as $key => $value) {
				if (is_numeric ($key)) {
					$this->abcc[] = $value;
				} elseif (is_string ($key) && is_string ($value)) {
					$value = str_replace('"', '', $value);
					$this->abcc[] = "\"$value\" <$key>";
				}
			}
		} else {
			$this->abcc = array ($address);
		}
		return true;
	}

	function SetCharset($charset) {
		if (!empty ($charset)) {
			$this->charset = strtolower ($charset);
			if ($this->charset != "us-ascii") {
				$this->ctencoding = "8bit";
			}
		}
	}

	function Body ($body = "", $charset = "") {
		$this->body = $body;
		$this->SetCharset($charset);
		return true;
	}

	function Text ($body = "", $charset = "") {
		// alias for Body()
		return $this->Body($body, $charset);
	}

	function Html($html_message = "", $charset = "") {
		$this->html = $html_message;
		$this->SetCharset($charset);
		return true;
	}

	function Organization ($org = "") {
		if (empty($org)) {
			unset($this->xheaders['Organization']);
		} else {
			$this->xheaders['Organization'] = $org;
		}
		return true;
	}

	function AntiSpaming ($client_ip = "", $proxy_server = "", $user_agent = "") {
		if (empty ($client_ip)) {
			if (isset ($_SERVER['HTTP_X_FORWARDED_FOR']))
			{ $client_ip = $_SERVER['HTTP_X_FORWARDED_FOR']; }
			elseif (isset ($_SERVER['HTTP_CLIENT_IP']))
			{ $client_ip = $_SERVER['HTTP_CLIENT_IP']; }
			elseif (isset ($_SERVER['HTTP_FROM']))
			{ $client_ip = $_SERVER['HTTP_FROM']; }
			elseif (isset ($_SERVER['REMOTE_ADDR']))
			{ $client_ip = $_SERVER['REMOTE_ADDR']; }
			$this->xheaders['X-HTTP-Posting-Host'] = $client_ip;
		} else {
			$this->xheaders['X-HTTP-Posting-Host'] = $client_ip;
		}

		if (empty ($proxy_server)) {
			if ($client_ip != $_SERVER['REMOTE_ADDR'])
			{ $this->xheaders['X-HTTP-Proxy-Server'] = $_SERVER['REMOTE_ADDR']; }
		} else {
			$this->xheaders['X-HTTP-Proxy-Server'] = $proxy_server;
		}

		if (empty ($user_agent)) {
			if (isset ($_SERVER['HTTP_USER_AGENT'])) {
				$this->xheaders['X-HTTP-Posting-UserAgent'] = $_SERVER['HTTP_USER_AGENT'];
			} else {
				$this->xheaders['X-HTTP-Posting-UserAgent'] = "Unknown";
			}
		} else {
			$this->xheaders['X-HTTP-Posting-UserAgent'] = $user_agent;
		}

		return true;
	}

	function Priority ($priority = 3) {
		if (!isset($this->priorities[$priority])) {
			return false;
		}

		$this->xheaders["X-Priority"] = $this->priorities[$priority];
		return true;
	}

	function Attach ($filepath, $mimetype = "", $disposition = "inline", $filename = "") {
		if (empty ($filepath)) {
			return false;
		}

		if (empty ($mimetype)) {
			$mimetype = "application/x-unknown-content-type";
		}

		if (empty ($filename)) {
			$filename = basename ($filepath);
		}

		$this->attachments[] = array(
			'filename' => $filename,
			'filepath' => $filepath,
			'mimetype' => $mimetype,
			'disposition' => $disposition
		);
		return true;
	}

	function AttachString($content, $mimetype = "text/html", $disposition = "inline", $filename = "") {
		if (empty($content)) {
			return false;
		}

		if (empty($mimetype)) {
			$mimetype = "application/x-unknown-content-type";
		}

		$this->attachments[] = array(
			'filename' => $filename,
			'content' => $content,
			'mimetype' => $mimetype,
			'disposition' => $disposition
		);
	}

	function Relate($filepath, $mimetype = "", $filename = "") {
		if (empty ($filepath)) {
			return false;
		}

		if (empty ($mimetype)) {
			$mimetype = "application/x-unknown-content-type";
		}

		if (empty ($filename)) {
			$filename = basename ($filepath);
		}

		$count_related = count($this->related);
		$cid = "CID-" . $count_related;
		$this->related[] = array(
			'filename' => $filename,
			'filepath' => $filepath,
			'mimetype' => $mimetype,
			'cid' => $cid
		);
		return $cid;
	}

	function RelateString($content, $mimetype = "", $filename = "") {
		if (empty($content)) {
			return false;
		}

		if (empty($mimetype)) {
			$mimetype = "application/x-unknown-content-type";
		}

		$count_related = count($this->related);

		if (empty($filename)) {
			$filename = "file" . $count_related . ".bin";
		}

		$cid = "CID-" . $count_related;
		$this->related[] = array(
			'filename' => $filename,
			'content' => $content,
			'mimetype' => $mimetype,
			'cid' => $cid
		);
		return $cid;
	}

	function BuildMail () {
		$this->headers = "";
		$this->gheaders = "";

		if (count ($this->sendtoex) > 0) { 
			$this->xheaders['To'] = implode (", ", $this->sendtoex);
		}

		if (count ($this->acc) > 0) {
			$this->xheaders['CC'] = implode (", ", $this->acc);
		}

		if (count ($this->abcc) > 0) {
			$this->xheaders['BCC'] = implode ( ", ", $this->abcc);
		}

		if ($this->receipt) {
			if (isset ($this->xheaders["Reply-To"])) {
				$this->xheaders["Disposition-Notification-To"] = $this->xheaders["Reply-To"];
			} else {
				$this->xheaders["Disposition-Notification-To"] = $this->xheaders['From'];
			}
		}

		if ($this->charset != "") {
			$this->xheaders["Mime-Version"] = "1.0";
			$this->xheaders["Content-Type"] = "text/plain; charset=$this->charset";
			$this->xheaders["Content-Transfer-Encoding"] = $this->ctencoding;
		}

		$this->xheaders["X-Mailer"] = "Php/libMailv2.1.6";

		if ($this->html) {
			// build related
			if (empty($this->related) || !$this->Build_Related()) {
				// there are no related files - just output HTML
				$this->fullBody = $this->html;
				$this->mainctype = "text/html; charset=" . $this->charset;
			}

			if ($this->body) {
				// e-mail with Text and HTML bodies - setup multipart/alternative
				if (!$this->lev2boundary) {
					$this->lev2boundary = "--" . md5(uniqid("mylev2boundary".rand())) . "y";
				}

				$this->fullBody = "This is a multi-part message in MIME format.\n--"
				 . $this->lev2boundary . "\nContent-Type: text/plain; charset="
				 . $this->charset . "\nContent-Transfer-Encoding: "
				 . $this->ctencoding . "\n\n" . $this->body ."\n--"
				 . $this->lev2boundary . "\nContent-Type: "
				 . $this->mainctype . "\nContent-Transfer-Encoding: "
	 			 . $this->ctencoding . "\n\n" . $this->fullBody
	 			 ."\n--" . $this->lev2boundary . "--\n";

				$this->mainctype = "multipart/alternative;\n boundary=\""
				 . $this->lev2boundary . "\"";

			}

		} else {
			// e-mail with plain text only
			$this->fullBody = $this->body;
			$this->mainctype = "text/plain; charset=" . $this->charset;
		}

		if (count ($this->attachments) > 0) {
			$has_attach = $this->_build_attachement();
		} else {
			$has_attach = 0;
		}

		if ($has_attach == 0) {
			$this->xheaders["Content-Type"] = $this->mainctype;
		}

		reset ($this->xheaders);
		while (list ($hdr, $value) = each ($this->xheaders)) {
			$this->gheaders .= "$hdr: $value\n";
			if ($hdr != "Subject" && $hdr != "To") { /* don't duplicate headers set by mail() */
				$this->headers .= "$hdr: $value\n";
			}
		}

		return true;
	}

	function Send () {
		$this->BuildMail ();
		$strTo = implode (", ", $this->sendto);
		return mail ($strTo, $this->xheaders['Subject'], $this->fullBody, $this->headers);
	}

	function Get ($full_headers = true) {
		$this->BuildMail ();
		if ($full_headers) {
			$mail = $this->gheaders . "\n";
		} else {
			$mail = $this->headers . "\n";
		}
		$mail .= $this->fullBody;
		return $mail;
	}

	function _build_attachement () {
		$count = 0;
		$sep = chr(13) . chr(10);

		$ata = array();
		$k = 0;

		foreach ($this->attachments as $attach) {
			$basename = $attach['filename'];
			$ctype = $attach['mimetype']; // content-type
			$disposition = $attach['disposition'];

			if (isset($attach['filepath'])) {
				$filepath = $attach['filepath'];

				if (file_exists($filepath)) {
					$subhdr = "--" . $this->boundary
					 . "\nContent-type: $ctype;\n name=\"$basename\"\nContent-Transfer-Encoding: base64\nContent-Disposition: $disposition;\n filename=\"$basename\"\n";
					$ata[$k++] = $subhdr;
	
					$linesz = filesize ($filepath) + 1;
					$fp = fopen ($filepath, 'rb');
					$ata[$k++] = chunk_split (base64_encode (fread ($fp, $linesz)));
					fclose ($fp);
					$count++;
				}

			} elseif (isset($attach['content'])) {
				$content = $attach['content'];

				if ($content) {
					$subhdr = "--" . $this->boundary
					 . "\nContent-type: $ctype;"
					 . (strlen($basename) > 0 ? "\n name=\"$basename\"" : "")
					 . "\nContent-Transfer-Encoding: base64\nContent-Disposition: $disposition;\n filename=\"$basename\"\n";
					$ata[$k++] = $subhdr;
					$ata[$k++] = chunk_split (base64_encode ($content));
					$count++;
				}

			}
		}

		if ($count > 0) {
			$this->xheaders["Content-Type"] = "multipart/mixed;\n boundary=\"$this->boundary\"";

			$this->fullBody = "This is a multi-part message in MIME format.\n--" . $this->boundary
			 . "\nContent-Type: " . $this->mainctype
			 . "\nContent-Transfer-Encoding: " . $this->ctencoding . "\n\n"
			 . $this->fullBody ."\n";

			$this->fullBody .= implode ($sep, $ata);
			$this->fullBody .= "--" . $this->boundary . "--\n";
		}
		return $count;
	}

	function Build_Related() {
		$count = 0;
		$sep = chr(13) . chr(10);

		$ata = array();
		$k = 0;

		if (!$this->relboundary) {
			$this->relboundary = "--" . md5(uniqid("relboundary".rand())) . "z";
		}

		foreach ($this->related as $attach) {
			$basename = $attach['filename'];
			$ctype = $attach['mimetype']; // content-type
			$cid = $attach['cid'];
			if (isset($attach['filepath'])) {
				$filepath = $attach['filepath'];

				if (file_exists($filepath)) {
					$subhdr = "--" . $this->relboundary
					 . "\nContent-type: $ctype;\n name=\"$basename\""
					 . "\nContent-Transfer-Encoding: base64"
					 . "\nContent-ID: <$cid>"
					 . "\nContent-Disposition: inline;\n filename=\"$basename\"\n";
					$ata[$k++] = $subhdr;
	
					$linesz = filesize ($filepath) + 1;
					$fp = fopen ($filepath, 'rb');
					$ata[$k++] = chunk_split (base64_encode (fread ($fp, $linesz)));
					fclose ($fp);
					$count++;
				}

			} elseif (isset($attach['content'])) {
				$content = $attach['content'];

				if ($content) {
					$subhdr = "--" . $this->relboundary
					 . "\nContent-type: $ctype; \n name=\"$basename\""
					 . "\nContent-Transfer-Encoding: base64"
					 . "\nContent-ID: <$cid>"
					 . "\nContent-Disposition: inline;\n filename=\"$basename\"\n";
					$ata[$k++] = $subhdr;
					$ata[$k++] = chunk_split (base64_encode ($content));
					$count++;
				}

			}
		}

		if ($count > 0) {
			$this->fullBody = "This is a multi-part message in MIME format.\n"
			 . "--" . $this->relboundary
			 . "\nContent-Type: text/html; charset=" . $this->charset
			 . "\nContent-Transfer-Encoding: " . $this->ctencoding . "\n\n"
			 . $this->html ."\n";

			$this->fullBody .= implode ($sep, $ata);
			$this->fullBody .= "--" . $this->relboundary . "--\n";
			$this->mainctype = "multipart/related;\n boundary=\""
			 . $this->relboundary . "\"";

			return $count;

		} else {
			return false;
		}
	}
} // class Mail
?>
