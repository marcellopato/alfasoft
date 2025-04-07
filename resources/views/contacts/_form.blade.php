<div class="mb-3">
    <label for="name" class="form-label">Nome</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" 
           id="name" name="name" value="{{ old('name', $contact->name ?? '') }}">
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="contact" class="form-label">Contato</label>
    <input type="text" class="form-control @error('contact') is-invalid @enderror" 
           id="contact" name="contact" value="{{ old('contact', $contact->contact ?? '') }}">
    @error('contact')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" 
           id="email" name="email" value="{{ old('email', $contact->email ?? '') }}">
    @error('email')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>