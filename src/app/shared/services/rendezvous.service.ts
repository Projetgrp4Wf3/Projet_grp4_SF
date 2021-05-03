import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';

import { Observable } from 'rxjs';

import { PoDisclaimer } from '@portinari/portinari-ui';

import { TotvsResponse } from 'dts-backoffice-util';

import { IRendezvous } from '../model/rendezvous.model';

@Injectable()
export class RendezvousService {

    // FIXME: Ajuste o módulo
	private apiUrl = '/dts/datasul-rest/resources/prg/modulo/v1/rendezvous';

    constructor(private http: HttpClient) { }

    query(filters: PoDisclaimer[], page = 1, pageSize = 20): Observable<TotvsResponse<IRendezvous>> {

        let url = `${this.apiUrl}?pageSize=${pageSize}&page=${page}`;

        if (filters && filters.length > 0) {

            const urlParams = new Array<string>();

            filters.map(filter => {
                urlParams.push(`${filter.property}=${filter.value}`);
            });

            url = `${url}&${urlParams.join('&')}`;
        }

        return this.http.get<TotvsResponse<IRendezvous>>(url);
    }

    getById(id: number): Observable<IRendezvous> {
        return this.http.get<IRendezvous>(`${this.apiUrl}/${id}`);
    }

    create(model: IRendezvous): Observable<IRendezvous> {
        return this.http.post<IRendezvous>(`${this.apiUrl}`, model);
    }

    update(model: IRendezvous): Observable<IRendezvous> {
        return this.http.put<IRendezvous>(`${this.apiUrl}/${model.id}`, model);
    }

    delete(id: number): Observable<object> {
        return this.http.delete(`${this.apiUrl}/${id}`);
    }

}
