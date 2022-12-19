<div>
    <div style="display: flex; justify-content: center;">
        <form wire:submit.prevent="submit">
            <table>
                <tbody>
                    <tr>
                        <td>
                            <div>
                                Lunes:
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="lunesD" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="lunesN" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                Martes:
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="martesD" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="martesN" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                Miercoles:
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="miercolesD" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div> <select wire:model="miercolesN" name="" id="">
                                @foreach ($horas as $hora)
                                    <option value="{{ $hora }}">{{ $hora }}</option>
                                @endforeach
                            </select>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                Jueves:
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="juevesD" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div> <select wire:model="juevesN" name="" id="">
                                @foreach ($horas as $hora)
                                    <option value="{{ $hora }}">{{ $hora }}</option>
                                @endforeach
                            </select>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                Viernes:
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="viernesD" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div> <select wire:model="viernesN" name="" id="">
                                @foreach ($horas as $hora)
                                    <option value="{{ $hora }}">{{ $hora }}</option>
                                @endforeach
                            </select>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                Sabado:
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="sabadoD" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div> <select wire:model="sabadoN" name="" id="">
                                @foreach ($horas as $hora)
                                    <option value="{{ $hora }}">{{ $hora }}</option>
                                @endforeach
                            </select>
                        </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div>
                                Domingo:
                            </div>
                        </td>
                        <td>
                            <div>
                                <select wire:model="domingoD" name="" id="">
                                    @foreach ($horas as $hora)
                                        <option value="{{ $hora }}">{{ $hora }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </td>
                        <td>
                            <div> <select wire:model="domingoN" name="" id="">
                                @foreach ($horas as $hora)
                                    <option value="{{ $hora }}">{{ $hora }}</option>
                                @endforeach
                            </select>
                        </div>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div>
                <button class="btn-flotante" type="submit"><i class="fas fa-save"></i></button>
            </div>
        </form>
    </div>
</div>
