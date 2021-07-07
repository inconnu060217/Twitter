<?php
    class Tweet_Item {
        private $_id;
        private $_fullname;
        private $_username;
        private $_date;
        private $_content;
        private $_picture;
        private $_comments;

        public function __construct($info, bool $bool = false) {
            spl_autoload_register(function ($class_name) {
                require_once(find_file("/models/$class_name.php"));
            });

            setlocale(LC_TIME, 'fr_FR.utf8'); 
            $str_date = $bool == true ? $info['comment_date'] : $info['tweet_date'];
            $this->_date = new DateTime($str_date);

            $this->_id =  $bool ? $info['comment_id'] : $info['tweet_id'];
            $this->_content = $info['content'];
            
            $users = new Users();
            $info['user'] = $users->getById($info['user_id'])[0];
            $users->closeConnection();

            $this->_fullname = $info['user']['fullname'];
            $this->_username = $info['user']['username'];
            $this->_picture = $info['user']['picture'];

            if(!$bool) {
                $comments = new Comments();
                $this->_comments = [];
                $array = $comments->getById($this->_id);
                $comments->closeConnection();
                foreach ($array as $comment) {
                    array_push($this->_comments, new Tweet_Item($comment, true));
                }
            }
        }

        public function getId() { return $this->_id; }
        public function getFullName() { return $this->_fullname; }
        public function getUsername() { return $this->_username; }
        public function getPicture() { return $this->_picture; }
        public function getComments() { return $this->_comments; }


        public function getDate() { 
            $date = $this->_date;
            $now = new DateTime(date("Y/m/d H:i:s"));
            $interval = $now->diff($date);
            //if there is no difference in days
            if(!(int) $interval->format('%a')) {
                //if it's within minutes we show mins else we show hours
                if(!(int) $interval->format('%h')) return $interval->format('%i min') . PHP_EOL; 
                else return $interval->format('%hh') . PHP_EOL; 
            } else {
                //if it's within days we show the day and the month and if we passed a year we also show the year
                if($now->format('y') == $date->format('y')) return strftime('%e %b', $date->format('U')) . PHP_EOL;
                else return strftime('%e %b %Y', $date->format('U')) . PHP_EOL;
            }
        }

        public function getFullDate() {
            return strftime('%R . %e %B %Y', $this->_date->format('U'));
        }

        public function getContent() { 
            $content = $this->_content;
    
            $match = [];
            preg_match_all("/( +|\s+)?(#\w+)/", $content, $match);
            foreach($match[2] as $str) {
                $sub = substr(trim($str), 1);
                $hashtags = new Hashtags();
                $exist = $hashtags->getById($sub);
                $hashtags->closeConnection();
                if(isset($exist)) $content = str_replace($str, "<a href=\"search.php?q=$sub\"><font color=\"#1da1f2\">$str</font></a>", $content); 
            }

            $match = [];
            preg_match_all("/( +|:?^|\s)(@\w*)( +|:?$|\s)/", $content, $match);
            foreach ($match[2] as $k => $str) {
                $sub = substr(trim($str), 1);
                $users = new Users();
                $exist = $users->getByUsername($sub);
                $users->closeConnection();
                if(isset($exist)) $content = str_replace($str, "<a href=\"profile.php?username=$sub\"><font color=\"#1da1f2\">$str</font></a>", $content); 
            }

            $match = [];
            preg_match("/http:\/\/lo\.cal\/\w*/", $content, $match);
            foreach($match as $str) {
                $id = basename($str);
                $path = realpath(find_file('images/storage'));
                $file = glob("./images/storage/$id*")[0];
                // var_dump($path, $file);
                $content = str_replace($str, "<a href=\"$file\" class='img_link'>$str</a>", $content);
            }

            $this->content = $content;
            return $this->content; 
        } 
    }