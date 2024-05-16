namespace montisgal_events.domain.Shared.Exceptions;

public class DomainValidationException() : Exception
{
    public Dictionary<string, string> Errors { get; private set; } = new();
    
    public DomainValidationException(string key, string value) : this()
    {
        Errors.Add(key, value);
    }

    public void AddErrors(string key, string value)
    {
        Errors.Add(key, value);
    }

    public void AddErrors(Dictionary<string, string> errors)
    {
        Errors = Errors.Union(errors).ToDictionary();
    }

    public bool HasErrors()
    {
        return Errors.Count > 0;
    }
}