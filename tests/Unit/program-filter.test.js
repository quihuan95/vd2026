import assert from 'node:assert/strict';
import { readFileSync } from 'node:fs';
import test from 'node:test';
import { createProgramFilter } from '../../resources/js/program-filter.js';

const rows = JSON.parse(readFileSync(new URL('../../resources/program.json', import.meta.url), 'utf8'));

test('shows the complete program without filters', () => {
    const filter = createProgramFilter(rows);
    assert.deepEqual(filter.matchingRowIndices(), rows.map((row, index) => index));
});

test('combines room and session filters without showing unrelated headings', () => {
    const filter = createProgramFilter(rows);
    filter.selectedRoom = filter.rooms.find((room) => room.label.includes('207')).id;
    filter.selectedSession = '2';

    const visible = filter.matchingRowIndices().map((index) => rows[index]);
    assert.equal(visible.filter((row) => row.kind === 'hall').length, 1);
    assert.equal(visible.filter((row) => row.kind === 'session').length, 1);
    assert.match(visible.find((row) => row.kind === 'session').cells[0][0], /Phiên 2: Điều dưỡng/);
    assert.ok(visible.some((row) => row.cells.flat().includes('ThS Phạm Đức Mục')));
});

test('searches English presentation titles within the selected session', () => {
    const filter = createProgramFilter(rows);
    filter.selectedSession = '1';
    filter.searchQuery = '  UTERINE TRANSPLANTATION  ';

    const visible = filter.matchingRowIndices().map((index) => rows[index]);
    assert.equal(visible.filter((row) => row.kind === 'presentation').length, 1);
    assert.ok(visible.some((row) => row.cells.flat().includes('GS. Ömer Özkan')));
});

test('returns no rows when the room has no selected session or keyword match', () => {
    const filter = createProgramFilter(rows);
    filter.selectedRoom = filter.rooms.find((room) => room.label.includes('207')).id;
    filter.selectedSession = '1';
    assert.deepEqual(filter.matchingRowIndices(), []);

    filter.selectedSession = '2';
    filter.searchQuery = 'nonexistent presentation xyz';
    assert.deepEqual(filter.matchingRowIndices(), []);
});

test('reset restores all rooms, sessions and presentations', () => {
    const filter = createProgramFilter(rows);
    filter.selectedRoom = filter.rooms[0].id;
    filter.selectedSession = '4';
    filter.searchQuery = 'test';
    filter.resetFilters();

    assert.equal(filter.searchQuery, '');
    assert.equal(filter.selectedRoom, '');
    assert.equal(filter.selectedSession, '');
    assert.equal(filter.matchingRowIndices().length, rows.length);
});
