import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { PoModule, PoI18nPipe } from '@portinari/portinari-ui';

import { RendezvousService } from '../shared/services/rendezvous.service';
import { RendezvousEditComponent } from './edit/rendezvous.edit.component';
import { RendezvousListComponent } from './rendezvous.list.component';
import { RendezvousRoutingModule } from './rendezvous-routing.module';

import { LoadingInterceptorModule } from '../loading-interceptor.module';

@NgModule({
    imports: [
        CommonModule,
        LoadingInterceptorModule,
        PoModule,
        FormsModule,
        ReactiveFormsModule,
        HttpClientModule,
        RendezvousRoutingModule
    ],
    declarations: [
        RendezvousListComponent,
        RendezvousEditComponent
    ],
    exports: [
        RendezvousListComponent
    ],
    providers: [
        PoI18nPipe,
        RendezvousService
    ],
})
export class RendezvousModule { }

