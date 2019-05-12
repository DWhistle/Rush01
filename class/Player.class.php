<?php
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/IDrawable.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/ISelectable.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/class/Db.class.php');
class Player implements IDrawable, ISelectable
{
    private $ships = array();
    private $state = false;
    private $active_ship = null;
    private $name = "";
    private $login;
    private $faction;
    private $room_id;
    private $icon = "";
    private $id;
    private $password;

    public function __construct($array)
    {
        if (is_array($array)) {
            $this->name = $array['name'];
            $this->ships = $array['ships'];
            $this->icon = $array['icon'];
            if (array_key_exists('state', $array))
                $this->state = $array['state'];
        }
        else
        {
            if ($array instanceof Player) {
                $player = $array;
                $this->ships = $player->getShips();
                $this->state = $player->getState();
                $this->active_ship = $player->getActive_ship();
                $this->name = $player->getName();
                $this->icon = $player->getIcon();
            }
        }
    }

    public function addShip(&$ship)
    {
        if ($ship instanceof Ship)
            $this->ships[] = $ship;
    }

    public function getHtml()
    {
        $html = <<<EOF
    <div class="player">
        <div>
            <img src="{$this->getIcon()}">
        </div>
        <div>
            <p>$this->name</p>
        </div>
    </div>
EOF;
        if (!empty($this->ships)) {
            foreach ($this->ships as $ship) {
                $html .= $ship->getJs();
            }
        }
        return $html;

    }
    public function draw()
    {
        echo "{$this->getHtml()}";
    }

    /**
     * @return array|mixed
     */
    public function getShips()
    {
        return $this->ships;
    }

    public function getState(){
        return $this->state;
    }

    /**
     * @return mixed|string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param null $active_ship
     */
    public function setActiveShip(&$active_ship)
    {
        //if ($active_ship instanceof Ship)
        //    $active_ship->setState('move');
        $this->active_ship = $active_ship;
    }

    /**
     * @return null
     */
    public function getActiveShip()
    {
        return $this->active_ship;
    }

    public function getCss()
    {
        // TODO: Implement getCss() method.
    }

    public function getJs()
    {
        // TODO: Implement getJs() method.
    }


    public function move($num, $move_points, $attack_points, $repair_point)
    {
        $curr_ship = null;

        foreach ($this->ships as $ship) {
            if ($ship->getId() == $num) {
                $curr_ship = $ship;
                break;
            }
        }
        if ($curr_ship instanceof Ship) {
            $pp = $curr_ship->getPP();
            if ($move_points + $attack_points + $repair_point == $pp) {
                $curr_ship->move($move_points);
                //$curr_ship->attack($attack_points);
                $curr_ship->repair($repair_point);
                $curr_ship->setPP($curr_ship->getMaxPp());
                $curr_ship->setState('move');
            }
            else if ($move_points + $attack_points + $repair_point < $pp) {
                $curr_ship->move($move_points);
                //$curr_ship->attack($attack_points);
                $curr_ship->repair($repair_point);
                $curr_ship->setPP($pp - ($move_points + $attack_points + $repair_point));
            }
        }
        return (0);

    }

    public function finish()
    {
        foreach ($this->ships as $ship) {
            if ($ship instanceof Ship)
                $ship->setState('active');
        }
    }

    /**
     * @return string
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * @param string $icon
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
    }

    /**
     * @param array $ships
     */
    public function setShips($ships)
    {
        $this->ships = $ships;
    }

    public function isActive()
    {
        foreach ($this->ships as $ship) {
            if ($ship->getState() == 'active')
                return true;
        }
        return false;
    }

    /**
     * @param bool $state
     */
    public function setState($state)
    {
        $this->state = $state;
        foreach ($this->ships as $ship) {
            $ship->setState($state);
        }
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getFaction()
    {
        return $this->faction;
    }

    /**
     * @param mixed $faction
     */
    public function setFaction($faction)
    {
        $this->faction = $faction;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getRoomId()
    {
        return $this->room_id;
    }

    /**
     * @param mixed $room_id
     */
    public function setRoomId($room_id)
    {
        $this->room_id = $room_id;
    }

    public static function getById($id)
    {
        $mysql = new Db();
        $sql = "SELECT u.id, u.login, u.faction, u.player_name, u.room_id, u.state
            FROM game_users u WHERE u.id = $id";
        $db_players = $mysql->getFromSelect($sql);
        $pl = null;
        if (!empty($db_players))
            $pl = new Player([
                'state' => $db_players[0]['state'],
                'name' => $db_players[0]['player_name'],
                'ships' => [],
                'icon' => ''
            ]);
        return $pl;
    }

    public static function getAll()
    {
        $mysql = new Db();
        return ($mysql->getTable('game_users'));
    }

    public function addToDb()
    {
        $db = new Db();
        if (empty($ret = $db->getTableById('game_users', $this->id))) {
            $sql =
"INSERT INTO game_users (login, passwd, faction, room_id, player_name, state)
 VALUES ({$this->login}, {$this->password}, {$this->faction}, {$this->room_id}, {$this->name}, {$this->state})";

            $db = new Db();
            $this->id = $db->execute($sql)['id'];
        }
        else
        {
            $sql = "UPDATE game_users SET 
                        login = {$this->login}, 
                        passwd = {$this->password}, 
                        faction = {$this->faction}, 
                        room_id = {$this->room_id}, 
                        player_name = {$this->name}, 
                        state =  {$this->state})
                    WHERE id = $this->id";
            $db = new Db();
            $db->execute($sql);
        }
    }

    public static function removeFromDb($id)
    {
        $sql = "DELETE FROM game_users WHERE id = {$id}";
        $db = new Db();
        $db->execute($sql);
    }

}


