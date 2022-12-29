<?php

namespace App\Subscribers\Record;

use App\Events\Record;
use App\Subscribers\BaseSubscriber;

class RecordSubscriber extends BaseSubscriber
{
	/**
	 * Create the event listener.
	 *
	 * @return void
	 */
	public function __construct()
	{
	}

	/**
	 * @param Record\RecordStoredEvent $event
	 */
	public function recordStored(Record\RecordStoredEvent $event)
	{
		$record = $event->record;
		// Log
		$this
			->setModel($record)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $record->name,
			])
			->setClickAction([
				'model' => $record->id,
			])
			->log();
	}

	/**
	 * @param Record\RecordUpdatedEvent $event
	 */
	public function recordUpdated(Record\RecordUpdatedEvent $event)
	{
		$record = $event->record;
		// Log
		$this
			->setModel($record)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $record->name,
			])
			->setClickAction([
				'model' => $record->id,
			])
			->log();
	}

	/**
	 * @param Record\RecordDestroyedEvent $event
	 */
	public function recordDestroyed(Record\RecordDestroyedEvent $event)
	{
		$record = $event->record;
		// Log
		$this
			->setModel($record)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $record->name,
			])
			->log();
	}

	/**
	 * @param Record\RecordRestoredEvent $event
	 */
	public function recordRestored(Record\RecordRestoredEvent $event)
	{
		$record = $event->record;
		// Log
		$this
			->setModel($record)
			->setLabel(__FUNCTION__)
			->setBody([
				'subject' => $record->name,
			])
			->log();
	}

	/**
	 * @param $events
	 * @return void
	 */
	public function subscribe($events): void
	{
		$events->listen(Record\RecordStoredEvent::class, self::class . '@recordStored');

		$events->listen(Record\RecordUpdatedEvent::class, self::class . '@recordUpdated');

		$events->listen(Record\RecordDestroyedEvent::class, self::class . '@recordDestroyed');

		$events->listen(Record\RecordRestoredEvent::class, self::class . '@recordRestored');
	}
}
