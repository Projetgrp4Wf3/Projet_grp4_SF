export interface IRendezvous {
    id: number;
    name: string;
}

export class Rendezvous implements IRendezvous {

    id: number;
    name: string;

    constructor(values: Object = {}) {
        Object.assign(this, values);
    }

    get $id() {
        return this.id;
    }

    get $name() {
        return this.name;
    }

    set $id(id: number) {
        this.id = id;
    }

    set $name(name: string) {
        this.name = name;
    }

    static of(json: any = {}) {
        return new Rendezvous(json);
    }

    static empty() {
        return new Rendezvous();
    }

    static fromJson(json: Array<any> = []) {

        const items: Array<IRendezvous> = [];

        for (const values of json) {
            items.push(new Rendezvous(values));
        }

        return items;
    }

}
