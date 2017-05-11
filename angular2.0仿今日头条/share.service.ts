import { Injectable } from '@angular/core';
import { Subject } from 'rxjs/Subject';
import { Subscription } from 'rxjs/Subscription';


interface Event {
  source: Subject<any>,
  observable: any
}

@Injectable()
export class ShareService {

  private eventMap: Map<string, Event> = new Map<string, Event>();
  constructor() {
  }

  emit(eventName: string, data?: any): boolean {
    if (this.eventMap.has(eventName)) {
      this.eventMap.get(eventName).source.next(data);
      return true;
    }
    return false;
  }

  on(eventName: string, handler: Function): Subscription {
    let eventObservable;
    if (!this.eventMap.has(eventName)) {
      let eventSource = new Subject<any>();
      eventObservable = eventSource.asObservable();
      this.eventMap.set(eventName, { source: eventSource, observable: eventObservable });
    } else {
      eventObservable = this.eventMap.get(eventName).observable;
    }
    return eventObservable.subscribe(handler);
  }
}
