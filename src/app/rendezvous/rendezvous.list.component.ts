import { Component, OnDestroy, OnInit, ViewChild } from '@angular/core';
import { Router } from '@angular/router';

import {
    PoBreadcrumb, PoDisclaimerGroup, PoDisclaimer, PoModalAction,
    PoModalComponent, PoPageAction, PoPageFilter, PoTableColumn,
    PoI18nService, PoI18nPipe, PoNotificationService
} from '@portinari/portinari-ui';

import { forkJoin, Subscription } from 'rxjs';

import { TotvsResponse } from 'dts-backoffice-util';

import { IRendezvous } from '../shared/model/rendezvous.model';
import { RendezvousService } from '../shared/services/rendezvous.service';

@Component({
    selector: 'app-rendezvous',
    templateUrl: './rendezvous.list.component.html',
    styleUrls: ['./rendezvous.list.component.css']
})
export class RendezvousListComponent implements OnInit, OnDestroy {

    @ViewChild('modalDelete', { static: false }) modalDelete: PoModalComponent;

    private itemsSubscription$: Subscription;
    private disclaimers: Array<PoDisclaimer> = [];

    cancelDeleteAction: PoModalAction;
    confirmDeleteAction: PoModalAction;

    pageActions: Array<PoPageAction>;
    tableActions: Array<PoPageAction>;

    breadcrumb: PoBreadcrumb;
    disclaimerGroup: PoDisclaimerGroup;
    filterSettings: PoPageFilter;

    items: Array<IRendezvous> = new Array<IRendezvous>();
    columns: Array<PoTableColumn>;

    hasNext = false;
    pageSize = 20;
    currentPage = 0;
    isLoading = true;
    quickSearchValue = '';
    moreSelected = false;
    selectedLength = 0;

    literals: any = {};

    constructor(
        private service: RendezvousService,
        private poI18nPipe: PoI18nPipe,
        private poI18nService: PoI18nService,
        private poNotification: PoNotificationService,
        private router: Router,
    ) { }

    ngOnInit(): void {
        forkJoin(
            this.poI18nService.getLiterals(),
            this.poI18nService.getLiterals({ context: 'rendezvous' })
        ).subscribe(literals => {
            literals.map(item => Object.assign(this.literals, item));
            this.setupComponents();
            this.search();
        });
    }

    searchByName(filter = [{ property: 'name', value: this.quickSearchValue }]): void {
        this.disclaimers = [...filter];
        this.disclaimerGroup.disclaimers = [...this.disclaimers];
    }

    search(loadMore = false): void {

        const disclaimer = this.disclaimers || [];

        if (loadMore === true) {
            this.currentPage = this.currentPage + 1;
        } else {
            this.items = [];
            this.currentPage = 1;
        }

        this.isLoading = true;
        this.itemsSubscription$ = this.service
            .query(disclaimer, this.currentPage, this.pageSize)
            .subscribe((response: TotvsResponse<IRendezvous>) => {
                this.items = [...this.items, ...response.items];
                this.hasNext = response.hasNext;
                this.isLoading = false;
            });
    }

    private delete(): void {

        let count = 0;
        const selected = this.items.filter((item: any) => item.$selected);

        if (selected.length > 0) {
            selected.map((item: IRendezvous) => {
                this.service.delete(item.id).subscribe(response => {
                    this.poNotification.success(
                        this.poI18nPipe.transform(
                            this.literals['excludedMessage'], [item.name]
                        )
                    );
                    if (++count === selected.length) {
                        this.search();
                    }
                }, (err: any) => {
                    if (++count === selected.length) {
                        this.search();
                    }
                });
            });
        }
    }

    private edit(item: IRendezvous): void {
        this.router.navigate(['/rendezvous/edit', item.id]);
    }

    private resetFilters(): void {
        this.quickSearchValue = '';
    }

    private onChangeDisclaimer(disclaimers): void {
        this.disclaimers = disclaimers;
        if (this.disclaimers.length === 0) {
            this.resetFilters();
        }
        this.search();
    }

    private onConfirmDelete(): void {
        this.modalDelete.close();
        this.delete();
        this.selectedLength = 0;
        this.moreSelected = false;
    }

    private cancelDelete() {
        this.modalDelete.close();
        this.selectedLength = 0;
        this.moreSelected = false;
    }

    private selected() {
        return !this.items.find(item => item['$selected']);
    }

    private deleteModalValidate() {
        const selected = this.items.filter((item: any) => item.$selected);
        if (selected.length > 1) {
            this.moreSelected = true;
            this.selectedLength = selected.length;
        }
        this.modalDelete.open();
    }

    private setupComponents(): void {

        this.confirmDeleteAction = { 
            action: () => this.onConfirmDelete(), 
            label: this.literals['yes'] 
        };

        this.cancelDeleteAction = { 
            action: () => this.cancelDelete(), 
            label: this.literals['no'] 
        };

        this.pageActions = [
            {
                label: this.literals['addNewRendezvous'],
                action: () => this.router.navigate(['rendezvous/new']), icon: 'po-icon-plus'
            },
            { 
                label: this.literals['remove'], 
                action: () => this.deleteModalValidate(), 
                disabled: () => this.selected()
            }
        ];

        this.columns = [
            { 
                property: 'name', 
                label: this.literals['name'], 
                type: 'link', 
                action: (value, row) => this.edit(row) 
            }
        ];

        this.breadcrumb = {
            items: [
                { 
                    label: this.literals['rendezvous'], 
                    link: '/rendezvous' 
                }
            ]
        };

        this.disclaimerGroup = {
            title: this.literals['filters'],
            disclaimers: [],
            change: this.onChangeDisclaimer.bind(this)
        };

        this.filterSettings = {
            action: 'searchByName',
            ngModel: 'quickSearchValue',
            placeholder: this.literals['search']
        };
    }

    ngOnDestroy(): void {
        this.itemsSubscription$.unsubscribe();
    }
}
