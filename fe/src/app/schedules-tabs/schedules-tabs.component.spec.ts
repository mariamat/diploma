import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { SchedulesTabsComponent } from './schedules-tabs.component';

describe('SchedulesTabsComponent', () => {
  let component: SchedulesTabsComponent;
  let fixture: ComponentFixture<SchedulesTabsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ SchedulesTabsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(SchedulesTabsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
