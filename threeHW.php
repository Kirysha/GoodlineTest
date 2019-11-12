<?php
abstract class Publication
{
    abstract public function getSource();
    abstract public function getContent();
    abstract public function getAll();
}



class News extends Publication {

    public $title;
    public $text;
    public $link;
    public $created_at;
    public $updated_at;

    public function __construct($title,$text,$link,$created_at,$updated_at) {

        $this->text = $text;
        $this->link = $link;
        $this->title = $title;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }

    public function getSource()
    {
        return $this ->link;
    }

    public function getContent()
    {
        return $this ->text;
    }

    public function getAll()
    {
        $arr=['text' => $this->text, 'link'=>$this->link, 'title'=>$this->title, 'created_at'=>$this->created_at, 'updated_at'=>$this->updated_at];
        return $arr;
    }
}

class Announce extends Publication {


    public $title;
    public $text;
    public $author;
    public $created_at;
    public $updated_at;

    public function __construct($title,$text,$author,$created_at,$updated_at) {

        $this ->text = $text;
        $this ->author = $author;
        $this ->title = $title;
        $this ->created_at = $created_at;
        $this ->updated_at = $updated_at;
    }

    public function getSource()
    {
        return $this ->author;
    }

    public function getContent()
    {
        return $this ->text;
    }

    public function getAll()
    {
        $arr=['text' => $this->text, 'author'=>$this->author, 'title'=>$this->title, 'created_at'=>$this->created_at, 'updated_at'=>$this->updated_at];
        return $arr;
    }
}

class NewsDB {
    public function all(){
        $mySql = new MysqlConnection();
        $arr = $mySql->selectNews();
        $arrNews = [];
        foreach ($arr as $res) {
            $news = new News($res['title'],$res['text'],$res['link'],$res['created_at'],$res['updated_at']);
            array_push($arrNews, $news);
        }
        //print_r($arrNews);
        return $arrNews;

    }

    public function create($title, $text, $source){
        $mySql = new MysqlConnection();
        $mySql->insertNews($title, $text, $source);
        $news = $mySql->selectLastNews();
        return $news;
    }
}

class AnnounceDB {
    public function all(){
        $mySql = new MysqlConnection();
        $arr = $mySql->selectAnnounce();
        $arrAnnounce = [];
        foreach ($arr as $res) {
            array_push($arrAnnounce, new Announce($res['id'],$res['title'],$res['text'],$res['author'],$res['created_at'],$res['updated_at']));
        }
        return $arrAnnounce;
    }
    public function create($title, $text, $source){
        $mySql = new MysqlConnection();
        $mySql->insertAnnounce($title, $text, $source);
        $announce = $mySql->selectLastAnnounce();
        return $announce;
    }
}

class MysqlConnection {

    public function insertAnnounce($title, $text, $source){
        $pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8;","test", "test");
        //$arr = $pdo ->query('SELECT * FROM `announce`') -> fetch();
        $sql = "INSERT INTO `announces`( `title`, `text`, `author`, `created_at`, `updated_at`) VALUES (:title,:text,:author,:created_at,:updated_at)";
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':author', $source);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->execute();
    }

    public function insertNews(){
        $pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8;","test", "test");
        $sql = "INSERT INTO news( title, text, link, created_at, updated_at) VALUES (:title,:text,:link,:created_at,:updated_at)";
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':text', $text);
        $stmt->bindParam(':link', $source);
        $stmt->bindParam(':created_at', $created_at);
        $stmt->bindParam(':updated_at', $updated_at);
        $stmt->execute();
    }

    public function selectNews(){
        $pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8;","test", "test");
        $arr = $pdo ->query('SELECT * FROM `news`') -> fetchAll();
        return $arr;
    }

    public function selectAnnounce(){
        $pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8;","test", "test");
         $arr = $pdo ->query('SELECT * FROM `announces`') -> fetchAll();
        return $arr;
    }

    public function selectLastNews() {
        $pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8;","test", "test");
        $res = $pdo ->query('SELECT * FROM `news` ORDER BY id DESC LIMIT 1') -> fetch();
       return $news = new News($res['id'],$res['title'],$res['text'],$res['link'],$res['created_at'],$res['updated_at']);
    }

    public function selectLastAnnounce() {
        $pdo = new PDO("mysql:host=localhost;dbname=my_db;charset=utf8;","test", "test");
        $res = $pdo ->query('SELECT * FROM `announces` ORDER BY id DESC LIMIT 1')->fetch();
        return $announce = new Announce($res['id'],$res['title'],$res['text'],$res['author'],$res['created_at'],$res['updated_at']);
    }
}

//$announce = new AnnounceDB();
//$announce ->create("test", "test","test");
//print_r($news->create("тайтл", "текст", "link"));
//$perem = $news->all();
//echo $perem[0];
$announce = new AnnounceDB();
$announceArr = $announce->all();


$news = new NewsDB();
$newsArr = $news->all();

$arr = array_merge($newsArr,$announceArr);
//print_r($arr);
foreach ($arr as $res){
    $content = $res->getContent();
    echo $content."\n" ;

    $source = $res->getSource();
    echo $source."\n" ;
    echo "\n" ;
    echo "\n" ;
    echo "\n" ;
}

