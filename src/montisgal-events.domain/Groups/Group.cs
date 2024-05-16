using montisgal_events.domain.Shared.Exceptions;

namespace montisgal_events.domain.Groups;

public class Group
{
    private const int NameMinLength = 3;
    private const int NameMaxLength = 100;

    private const int DescriptionMaxLength = 1000;

    private string _name;
    private string? _description;
    private bool _isPublic;

    public Group(Guid id, string? name, string? description, bool? isPublic, Guid ownerId)
    {
        Validate(name, description, isPublic);

        Id = id;
        _name = name!;
        _description = description;
        _isPublic = (bool)isPublic!;
        OwnerId = ownerId;
    }

    public Guid Id { get; }

    public string Name
    {
        get => _name;
        set
        {
            ValidateName(value);
            _name = value;
        }
    }

    public string? Description
    {
        get => _description;
        set
        {
            ValidateDescription(value);
            _description = value;
        }
    }

    public bool IsPublic
    {
        get => _isPublic;
        set
        {
            ValidateIsPublic(value);
            _isPublic = value;
        }
    }

    public Guid OwnerId { get; }

    private static void Validate(string? name, string? description, bool? isPublic)
    {
        var domainValidationException = new DomainValidationException();

        try
        {
            ValidateName(name);
        }
        catch (DomainValidationException e)
        {
            domainValidationException.AddErrors(e.Errors);
        }

        try
        {
            ValidateDescription(description);
        }
        catch (DomainValidationException e)
        {
            domainValidationException.AddErrors(e.Errors);
        }

        try
        {
            ValidateIsPublic(isPublic);
        }
        catch (DomainValidationException e)
        {
            domainValidationException.AddErrors(e.Errors);
        }

        if (domainValidationException.HasErrors()) throw domainValidationException;
    }

    private static void ValidateName(string? name)
    {
        if (string.IsNullOrWhiteSpace(name))
        {
            throw new DomainValidationException("name", "Name is required");
        }

        switch (name.Length)
        {
            case < NameMinLength:
                throw new DomainValidationException("name", $"Name min length is {NameMinLength}");
            case > NameMaxLength:
                throw new DomainValidationException("name", $"Name max length is {NameMaxLength}");
        }
    }

    private static void ValidateDescription(string? description)
    {
        if (description is not null &&
            (description.Length > DescriptionMaxLength || string.IsNullOrWhiteSpace(description)))
        {
            throw new DomainValidationException("description", $"Description max length is {DescriptionMaxLength}");
        }
    }
    
    private static void ValidateIsPublic(bool? isPublic)
    {
        if (isPublic is null) throw new DomainValidationException("isPublic", "IsPublic is required");
    }
}