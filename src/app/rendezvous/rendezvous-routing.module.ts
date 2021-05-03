import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { RendezvousEditComponent } from './edit/rendezvous.edit.component';
import { RendezvousListComponent } from './rendezvous.list.component';

const routes: Routes = [
    {
        path: '',
        component: RendezvousListComponent,
    },
    {
        path: 'new',
        component: RendezvousEditComponent
    },
    {
        path: 'edit/:id',
        component: RendezvousEditComponent
    }
];

@NgModule({
    declarations: [],
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule]
})

export class RendezvousRoutingModule { }
