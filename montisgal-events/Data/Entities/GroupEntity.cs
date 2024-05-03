using System.ComponentModel.DataAnnotations;
using Microsoft.AspNetCore.Identity;

namespace montisgal_events.Data.Entities;

public class GroupEntity(Guid id, string name, string description, bool isPublic, string ownerId)
{
    [Key] public Guid Id { get; init; } = id;

    [MaxLength(100)] public string Name { get; set; } = name;

    [MaxLength(1000)] public string Description { get; set; } = description;

    public bool IsPublic { get; set; } = isPublic;

    public string OwnerId { get; set; } = ownerId;

    public IdentityUser Owner { get; set; }
}