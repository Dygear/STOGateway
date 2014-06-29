<?php

namespace STO;

class gateway
{
	public $json;

	private $Proxy_LoginSuccess;
	private $Proxy_DefaultResource;
	private $Proxy_Resource;

	private $Proxy_LoginEntity;
	private $Proxy_Pet;
	private $Proxy_Entity;
	private $Proxy_PersonalProject;

	private $Proxy_GroupProject;
	private $Proxy_Guild;

	public function __construct()
	{
		$file = file_get_contents('./xhr-response.json');
		$json = substr($file, 4);
		$this->json = json_decode($json)->args[0]->container;
	}
}

class leaderboard
{
	const EMBASSY = 0;
	const MINE = 1;
	const SPIRE = 2;
	const STARBASE = 3;

	public $states;

	public function __construct($states)
	{
		$this->states = $states;
	}

	public function getBoard($sort = SORT_DESC)
	{
		$leaderboard = $this->states->donationstats;

		array_multisort(
			array_map(function($leaderboard) use ($key) {
				return is_object($value) ? $value->$key : $value[$key];
			}, $leaderboard), SORT_NUMERIC, $sort, $leaderboard
		);

		return $leaderboard;
	}
}

class display
{
	public $leaderboard = [];

	public $start;
	public $to;

	public function __construct()
	{
		$this->start = file_get_contents('start.txt');
		$leader = (new leaderboard((new gateway())->json->states[leaderboard::STARBASE]))->getBoard();
		foreach ($leader as $Player)
			$this->to .= $Player->displayname . '	' . number_format($Player->contribution) . PHP_EOL;
	}

	public function parse($values)
	{
		$lines = explode(PHP_EOL, $values);
		$return = [];
		foreach ($lines as $line)
		{
			list($name, $score) = explode('	', $line);
			list($toon, $handle)= explode('@', $name);
			$score = str_replace(',', NULL, $score);

			$return []= [$toon, $handle, $score];
		}

		return $return;
	}

	public function compare($from, $to)
	{
		$_from = [];
		foreach ($this->parse($from) as $line)
		{
			list($toon, $handle, $score) = $line;
			if (!isset($_from[$handle]))
				$_from[$handle] = 0;
			$_from[$handle] += $score;
		}

		$_to = [];
		foreach ($this->parse($to) as $line)
		{
			list($toon, $handle, $score) = $line;
			if (!isset($_to[$handle]))
				$_to[$handle] = 0;
			$_to[$handle] += $score;
		}

		$delta = [];
		foreach ($_to as $handle => $score)
		{
			if (!isset($delta[$handle]))
				$delta[$handle] = 0;

			$delta[$handle] += $_to[$handle] - ($_from[$handle] ?: 0);
		}

		arsort($delta);

		return $delta;
	}
}

?>
