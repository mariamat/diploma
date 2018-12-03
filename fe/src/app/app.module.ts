import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { TableModule } from 'ngx-easy-table';

import { AppComponent } from './app.component';
import { GridComponent } from './grid/grid.component';
import { DashboardComponent } from './dashboard/dashboard.component';
import { RegisterFormComponent } from './register-form/register-form.component';
import { LoginFormComponent } from './login-form/login-form.component';
import { SchedulesTabsComponent } from './schedules-tabs/schedules-tabs.component';
import { ScheduleGridComponent } from './schedule-grid/schedule-grid.component';
import { ScheduleFormComponent } from './schedule-form/schedule-form.component';
import { AppRoutingModule } from './app-routing.module';

@NgModule({
  declarations: [
    AppComponent,
    GridComponent,
    DashboardComponent,
    RegisterFormComponent,
    LoginFormComponent,
    SchedulesTabsComponent,
    ScheduleGridComponent,
    ScheduleFormComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    TableModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
